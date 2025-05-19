package org.example.personal_health_system.bean;

import java.util.List;
//主导航
public class MainMenu {
    private int id;
    private String title;
    private String path;
    private List<SubMenu> sList;

    public MainMenu() {
    }

    public MainMenu(String tilte, String path, List<SubMenu> slist) {
        this.title = tilte;
        this.path = path;
        this.sList = slist;
    }

    public int getId() {
        return id;
    }

    public String getTitle() {
        return title;
    }

    public String getPath() {
        return path;
    }

    public List<SubMenu> getsList() {
        return sList;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public void setPath(String path) {
        this.path = path;
    }

    public void setsList(List<SubMenu> sList) {
        this.sList = sList;
    }

    @Override
    public String toString() {
        return "MainMenu{" +
                "id=" + id +
                ", tilte='" + title + '\'' +
                ", path='" + path + '\'' +
                ", slist=" + sList +
                '}';
    }
}
