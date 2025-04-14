package cn.edu.gdufs.mall.service.impl;


import cn.edu.gdufs.mall.common.Constant;
import cn.edu.gdufs.mall.exception.dsMallException;
import cn.edu.gdufs.mall.exception.dsMallExceptionEnum;
import cn.edu.gdufs.mall.model.dao.UserMapper;
import cn.edu.gdufs.mall.model.pojo.User;
import cn.edu.gdufs.mall.service.UserService;
import java.security.NoSuchAlgorithmException;

import cn.edu.gdufs.mall.util.MD5Utils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

/**
 * 描述：     UserService实现类
 * 整体思路就是先进行合法性检验，合法则调用dao层访问数据库
 */
@Service
public class UserServiceImpl implements UserService {

    @Autowired      //@Autowired注解使得Spring能够自动装配这个DAO
    UserMapper userMapper;

    @Override
    public User getUser() {
        return userMapper.selectByPrimaryKey(1);
    }

    @Override
    public void register(String userName, String password) throws dsMallException {
        //查询用户名是否存在，不允许重名
        User result = userMapper.selectByName(userName);
        if (result != null) {
            throw new dsMallException(dsMallExceptionEnum.NAME_EXISTED);
        }
        //写到数据库
        User user = new User();
        user.setUsername(userName);
        user.setPassword(password); // 直接设置密码，不进行MD5加密
        int count = userMapper.insertSelective(user);       //调用userMapper插入用户
        if (count == 0) {
            throw new dsMallException(dsMallExceptionEnum.INSERT_FAILED);
        }
    }

    @Override
    public User login(String userName, String password) throws dsMallException {
        User user = userMapper.selectLogin(userName, password);   //通过用户名和密码查询用户
        if (user == null) {
            throw new dsMallException(dsMallExceptionEnum.WRONG_PASSWORD);
        }
        return user;
    }

    @Override
    public void updateInformation(User user) throws dsMallException {
        //更新个性签名
        int updateCount = userMapper.updateByPrimaryKeySelective(user);   //调用userMapper更新用户信息
        if (updateCount > 1) {
            throw new dsMallException(dsMallExceptionEnum.UPDATE_FAILED);
        }
    }

    @Override
    public boolean checkAdminRole(User user) {     //查用户是否是管理员
        //1是普通用户，2是管理员
        return user.getRole().equals(2);
    }
}
