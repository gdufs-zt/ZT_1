//http://localhost:8083

package cn.edu.gdufs.mall.controller;

import cn.edu.gdufs.mall.common.ApiRestResponse;
import cn.edu.gdufs.mall.common.Constant;
import cn.edu.gdufs.mall.exception.dsMallException;
import cn.edu.gdufs.mall.exception.dsMallExceptionEnum;
import cn.edu.gdufs.mall.model.pojo.User;
import cn.edu.gdufs.mall.service.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.util.StringUtils;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;

import javax.servlet.http.HttpSession;

/**
 * 描述：     用户控制器
 */
@Controller
public class UserController {
    //@Autowired注解用于自动注入UserService的实例，这样UserController就可以调用UserService中定义的方法
    @Autowired
    UserService userService;

    @GetMapping("/test")
    @ResponseBody
    public User personalPage() {
        return userService.getUser();    //用于获取用户的个人信息
    }

    /**
     * 注册
     */
    @PostMapping("/register")
    @ResponseBody
    public ApiRestResponse register(@RequestParam("userName") String userName,
                                    @RequestParam("password") String password) throws dsMallException {
        if (StringUtils.isEmpty(userName)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_USER_NAME);
        }
        if (StringUtils.isEmpty(password)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_PASSWORD);
        }
        //密码长度不能少于8位
        if (password.length() < 8) {
            return ApiRestResponse.error(dsMallExceptionEnum.PASSWORD_TOO_SHORT);
        }
        userService.register(userName, password);
        return ApiRestResponse.success();
    }

    /**
     * 登录
     * 方法的类型由其返回值决定
     * ApiRestResponse是一个自定义的响应类
     * throws dsMallException意味着方法在执行过程中可能会抛出dsMallException类型的异常
     * HttpSession session参数用于在用户成功登录后，将用户信息存储到会话中
     */
    @PostMapping("/login")
    @ResponseBody
    public ApiRestResponse login(@RequestParam("userName") String userName,
                                 @RequestParam("password") String password, HttpSession session)    //HttpSession参数不需要手动传递
            throws dsMallException {
        if (StringUtils.isEmpty(userName)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_USER_NAME);
        }
        if (StringUtils.isEmpty(password)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_PASSWORD);
        }
        User user = userService.login(userName, password);
        //保存用户信息时，不保存密码
        user.setPassword(null);
        //将用户信息（不包括密码）存储在会话中,这里Constant.DS_MALL_USER是一个常量
        //会话允许你在用户浏览Web应用程序时保持用户状态
        session.setAttribute(Constant.DS_MALL_USER, user);
        return ApiRestResponse.success(user);    //返回一个ApiRestResponse对象
    }

    /**
     * 更新个性签名
     */
    @PostMapping("/user/update")
    @ResponseBody
    public ApiRestResponse updateUserInfo(HttpSession session, @RequestParam String signature)
            throws dsMallException {
        User currentUser = (User) session.getAttribute(Constant.DS_MALL_USER);    //从会话中获取用户信息并转成User类型
        if (currentUser == null) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_LOGIN);
        }
        User user = new User();
        user.setId(currentUser.getId());
        user.setPersonalizedSignature(signature);
        userService.updateInformation(user);
        return ApiRestResponse.success();
    }

    /**
     * 登出，清除session
     */
    @PostMapping("/user/logout")
    @ResponseBody
    public ApiRestResponse logout(HttpSession session) {
        session.removeAttribute(Constant.DS_MALL_USER);
        return ApiRestResponse.success();
    }

    /**
     * 管理员登录接口
     */
    @PostMapping("/adminLogin")
    @ResponseBody
    public ApiRestResponse adminLogin(@RequestParam("userName") String userName,
                                      @RequestParam("password") String password, HttpSession session)
            throws dsMallException {
        if (StringUtils.isEmpty(userName)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_USER_NAME);
        }
        if (StringUtils.isEmpty(password)) {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_PASSWORD);
        }
        User user = userService.login(userName, password);
        //校验是否是管理员
        if (userService.checkAdminRole(user)) {
            //是管理员，执行操作
            //保存用户信息时，不保存密码
            user.setPassword(null);
            session.setAttribute(Constant.DS_MALL_USER, user);
            return ApiRestResponse.success(user);
        } else {
            return ApiRestResponse.error(dsMallExceptionEnum.NEED_ADMIN);
        }
    }
}
