package cn.edu.gdufs.mall.model.dao;

import cn.edu.gdufs.mall.model.pojo.User;
import org.apache.ibatis.annotations.Param;


public interface UserMapper {
    int deleteByPrimaryKey(Integer id);  //根据主键ID删除用户记录，返回影响的行数

    int insert(User record);  //插入一个新的用户记录，返回影响的行数

    int insertSelective(User record);  //插入一个新的用户记录，只插入不为null的字段，返回影响的行数

    User selectByPrimaryKey(Integer id);  //根据主键ID查询用户记录，返回User对象

    int updateByPrimaryKeySelective(User record);  //根据主键ID更新用户记录，只更新不为null的字段，返回影响的行数

    int updateByPrimaryKey(User record);  //根据主键ID更新用户记录，返回影响的行数

    User selectByName(String userName);  //根据用户名查询用户记录，返回User对象

    User selectLogin(@Param("userName") String userName, @Param("password") String password);  //根据用户名和密码查询用户记录，返回User对象。@Param注解用于在MyBatis的映射文件中指定参数名称
}

//@Param("name")和@Param("age")就是给方法参数起了昵称“name”和“age”
//在你的SQL语句里，你就可以直接用#{name}和#{age}来代表这两个参数，而不是每次都要把整个参数类型和变量名都写出来