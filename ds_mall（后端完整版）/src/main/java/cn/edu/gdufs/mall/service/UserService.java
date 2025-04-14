package cn.edu.gdufs.mall.service;

import cn.edu.gdufs.mall.exception.dsMallException;
import cn.edu.gdufs.mall.model.pojo.User;

/**
 * 描述：     UserService
 */
public interface UserService {

    User getUser();

    void register(String userName, String password) throws dsMallException;

    User login(String userName, String password) throws dsMallException;

    void updateInformation(User user) throws dsMallException;

    boolean checkAdminRole(User user);
}
