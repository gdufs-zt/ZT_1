//函数类型全部写成String

package org.example.personal_health_system.controller;

import com.alibaba.fastjson.JSON;
import org.example.personal_health_system.bean.QueryInfo;
import org.example.personal_health_system.bean.User;
import org.example.personal_health_system.dao.UserDao;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.RestController;

import javax.management.Query;
import java.util.HashMap;
import java.util.List;

@RestController
public class UserController {
    @Autowired
    private UserDao uDao;

    @RequestMapping("/alluser")
    public String getUserList(QueryInfo queryInfo) {
        //获取最大列表数和当前编号
      int numbers = uDao.getUserCounts( "%"+queryInfo.getQuery()+"%");
      int pageStart = (queryInfo.getPageNum()-1)*queryInfo.getPageSize();


      List<User> users = uDao.getAllUser("%"+queryInfo.getQuery()+"%", pageStart, queryInfo.getPageSize());
      HashMap<String, Object> res = new HashMap<>();
      res.put("numbers", numbers);
      res.put("data", users);
      String res_string = JSON.toJSONString(res);
      return res_string;
    }

    @RequestMapping("/userstate")
    public String updateUserState(@RequestParam("id") Integer id, @RequestParam("state") Boolean state) {
        int i = uDao.updateState(id, state);
        return i > 0 ? "success":"error";
    }

    @RequestMapping("/addUser")
    public String addUser(@RequestBody User user) {
        user.setRole("普通用户");
        user.setState(false);
        int i = uDao.addUser(user);
        return i > 0?"success":"error";
    }

    @RequestMapping("/deleteUser")
    public String deleteUser(int id) {
        int i = uDao.deleteUser(id);
        return i > 0 ? "success" : "error";
    }

    @RequestMapping("/getupdate")
    public String getUpdateUser(int id) {
        User user = uDao.getUpdateUser(id);
        String string = JSON.toJSONString(user);
        return string;
    }

    @RequestMapping("/edituser")
    public String editUser(@RequestBody User user) {
        int i = uDao.editUser(user);
        return i > 0 ? "success" : "error";
    }
}



