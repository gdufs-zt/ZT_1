package cn.edu.gdufs.mall.model.dao;

import cn.edu.gdufs.mall.model.pojo.Cart;
import cn.edu.gdufs.mall.model.vo.CartVO;
import io.swagger.models.auth.In;
import java.util.List;
import org.apache.ibatis.annotations.Param;
import org.springframework.stereotype.Repository;

@Repository
public interface CartMapper {
    int deleteByPrimaryKey(Integer id);

    int insert(Cart record);

    int insertSelective(Cart record);

    Cart selectByPrimaryKey(Integer id);

    int updateByPrimaryKeySelective(Cart record);

    int updateByPrimaryKey(Cart record);

    List<CartVO> selectList(@Param("userId") Integer userId);    //查询特定用户userId的所有购物车记录

    Cart selectCartByUserIdAndProductId(@Param("userId") Integer userId, @Param("productId")Integer productId);    //根据用户userId和产品productId查询特定的购物车记录


    //检查特定的购物车记录是否存在于用户的购物车中，并且根据selected参数检查其是否被选中
    Integer selectOrNot(@Param("userId") Integer userId, @Param("productId") Integer productId,
                        @Param("selected") Integer selected);
}