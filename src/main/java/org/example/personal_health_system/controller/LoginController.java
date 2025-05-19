package org.example.personal_health_system.controller;

import com.alibaba.fastjson.JSON;
import org.example.personal_health_system.bean.User;
import org.example.personal_health_system.dao.UserDao;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RestController;

import java.util.HashMap;

@RestController
public class LoginController {

    @Autowired     //依赖注入的注解
    UserDao userDao;

    @RequestMapping("/login")
    public String login(@RequestBody User user) {      //!!!!!!!!!该注解跟封装有关？传过来的数据变成user了？
        String flag = "error";         //标识符，判断是否登录成功
        User us = userDao.getUserByMassage(user.getUsername(), user.getPassword());
        System.out.println("user"+us);
        HashMap<String, Object> res = new HashMap<>();   //创建一个哈希表来存储登录信息，包括标识符和用户信息
        if (us != null) {           //us非空表示可以在数据库找到人
            flag = "ok";
        }
        res.put("flag", flag);
        res.put("user", user);
        String res_json = JSON.toJSONString(res);      //把登录信息转化成JSON形式
        return res_json;
    }
}
