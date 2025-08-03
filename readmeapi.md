# پروژه اموزشی api


# نوشته شده است api این پروژه با هدف اموزش و تسلط بر 

# های نوشته شدهapi لیست :
1) categories (برای دسته بندی دروس)
2) lessons  (برای مدیریت درس ها )
3) questions(برای مدیریت سوالات)
4) selectoption (برای سوالات چند گزینه ایی)
5) textanswers(برای پاسخ های متنی )
6) laravel sanctum (برای ورود و احراز هویت استفاده شده است)
7) useranswers(برای ثبت پاسخ کاربران)

# Database Relations (trees) :
Category
   └── hasMany → Lessons
               └── hasMany → Questions
                             ├── hasMany → SelectOptions
                             └── hasOne   → TextAnswer

User
   ├── hasMany → UserAnswers
   │             └── belongsTo → Question / SelectOption (nullable)
   └── hasMany → UserLessons
                 └── belongsTo → Lesson

# Database Relations(text):
1) Category->Lesson (one to many)
2) Lesson->Questions (one to many)
3) Questions-> SelectOption (one to many)
4) Questions-> TextAnswers (one to one)
5) User-> UserAnswers (one to many)
6) UserAnswer -> SelectOption (one to one, nullable, only for select questions)
7) User-> UserLessons (one to many)

# technologys:
1) php 8.x
2) laravel 12.x
3) sanctum for authentication
4) MYSQL for database

# installation :
- ```bash
- git clone https://github.com/sajjadhm14/api-project.git
- cd api-project
- composer install
- cp .env.example .env
- php artisan key:generate
- php artisan migrate
- php artisan serve 

# test project :
- {{base-url}}/api/login
- body : {
    "username" : "sajjadhamidi",
    "password" : "123456789"
}


# developer: 
- name : | sajjad hamidi|
- position : | laravel developer |
- call-number : 0910 765 4470
- telegram-id : @pharmoba 