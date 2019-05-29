<?php

Router::get("/","Home@Index");
Router::get("/home","Home@Index");
Router::get("/home/list","Home@Index");
Router::get("add","Home@Add");
Router::post("add","Home@Post_Add");
Router::get("user/delete/*","Home@Delete");


Router::get("/admin","AdminHome@Index");
Router::get("/admin/home","AdminHome@Index");
Router::get("admin/add","AdminHome@Add");
Router::post("admin/add","AdminHome@Post_Add");
Router::get("admin/user/delete/*","AdminHome@Delete");


Router::get("api/list","ApiDenemeController@list");
