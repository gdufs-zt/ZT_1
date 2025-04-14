package cn.edu.gdufs.mall.exception;

/**
 * 描述：     统一异常
 */
public class dsMallException extends RuntimeException {

    private final Integer code;
    private final String message;

    public dsMallException(Integer code, String message) {
        this.code = code;
        this.message = message;
    }

    public dsMallException(dsMallExceptionEnum exceptionEnum) {
        this(exceptionEnum.getCode(), exceptionEnum.getMsg());
    }

    public Integer getCode() {
        return code;
    }

    @Override
    public String getMessage() {
        return message;
    }
}
