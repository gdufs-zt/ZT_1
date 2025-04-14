package cn.edu.gdufs.mall.service;

import cn.edu.gdufs.mall.exception.dsMallException;
import com.github.pagehelper.PageInfo;
import cn.edu.gdufs.mall.model.pojo.Category;
import cn.edu.gdufs.mall.model.request.AddCategoryReq;
import cn.edu.gdufs.mall.model.vo.CategoryVO;

import java.util.List;

/**
 * 描述：     分类目录Service
 */
public interface CategoryService {

    void add(AddCategoryReq addCategoryReq) throws dsMallException;

    void update(Category updateCategory);

    void delete(Integer id);

    PageInfo listForAdmin(Integer pageNum, Integer pageSize);

    List<CategoryVO> listCategoryForCustomer(Integer parentId);
}
