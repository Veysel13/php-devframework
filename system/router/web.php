<?php


Router::get("/","Home@Index");
Router::get("home","Home@Index");
Router::get("add","Home@Add");
Router::post("add","Home@Post_Add");
Router::get("user/delete/*","Home@Delete");
Router::get("admin/home","AdminHome@Ekle");




