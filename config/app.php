<?php

/*
 | Project: fw
 | Description: my framework
 | Author: Pham Ngoc Phu
 | Alias: Phu Master
 | Email: phumaster.dev@gmail.com 
 */

/*
 *  file config app
 *  cấu hình cho ứng dụng.
 */
return [
    
    /*
     *  url của trang web, mặc định để trống = http://localhost
     */
    
    'base_url' => '',
    
    /*
     *  folder controllers, có thể edit nếu muốn lưu controller vào 1 thư mục khác
     *  Thư mục bắt buộc phải nắm trong thư muc app/
     */
    
    'controller_folder' => 'controllers',
    
    // thư mục chứa file cho view
    
    'view_folder' => 'views',
    
    // thư mục model/
    
    'model_folder' => 'models',
    
    // các thư viện muốn viết thêm.
    
    'library_folder' => 'libs',
    
    // các file ngôn ngữ.
    
    'lang_folder' => 'langs'
];