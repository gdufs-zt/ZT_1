package org.example.personal_health_system;

import org.mybatis.spring.annotation.MapperScan;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;

@MapperScan("org.example.personal_health_system.dao")   //这个注解经常遗漏导致报错，导致spring找不到dao或者bean
@SpringBootApplication
public class PersonalHealthSystemApplication {

    public static void main(String[] args) {
        SpringApplication.run(PersonalHealthSystemApplication.class, args);
    }

}
