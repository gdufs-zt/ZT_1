package org.example.personal_health_system.dao;


import org.apache.ibatis.annotations.Param;
import org.example.personal_health_system.bean.User;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface UserDao {
    //绿色的username对应xml映射文件select语句中的username
     public User getUserByMassage(@Param("username") String username, @Param("password") String password);  //该注解让参数找起来比较容易

     public List<User> getAllUser(@Param("username") String username, @Param("pageStart") int pageStart, @Param("pageSize") int pageSize);

     public int getUserCounts(@Param("username") String username);

     public int updateState(Integer id, Boolean state);   //跟修改相关函数类型用int

     public  int addUser(User user);

     public int deleteUser(int id);

     public User getUpdateUser(int id);

     public int editUser(User user);
}
