package cn.edu.gdufs.mall.service;

import cn.edu.gdufs.mall.model.request.CreateOrderReq;
import cn.edu.gdufs.mall.model.vo.OrderVO;
import com.github.pagehelper.PageInfo;

import java.util.Date;
import java.util.List;

/**
 * 描述：     订单Service
 */
public interface OrderService {


    String create(CreateOrderReq createOrderReq);

    OrderVO detail(String orderNo);

    PageInfo listForCustomer(Integer pageNum, Integer pageSize);

    void cancel(String orderNo);

    String qrcode(String orderNo);

    void pay(String orderNo);

    PageInfo listForAdmin(Integer pageNum, Integer pageSize);

    void deliver(String orderNo);

    void finish(String orderNo);
}
