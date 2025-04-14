package cn.edu.gdufs.mall.service;

import cn.edu.gdufs.mall.exception.dsMallException;
import cn.edu.gdufs.mall.model.pojo.User;
import cn.edu.gdufs.mall.model.vo.CartVO;
import java.util.List;

/**
 * 描述：     购物车Service
 */
public interface CartService {

    List<CartVO> list(Integer userId);    //获取指定用户userId的购物车列表,返回一个CartVO对象的列表

    List<CartVO> add(Integer userId, Integer productId, Integer count);    //向指定用户userId的购物车中添加商品

    List<CartVO> update(Integer userId, Integer productId, Integer count);

    List<CartVO> delete(Integer userId, Integer productId);

    List<CartVO> selectOrNot(Integer userId, Integer productId, Integer selected);   //是否选择

    List<CartVO> selectAllOrNot(Integer userId, Integer selected);     //是否全选
}
