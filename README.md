
# exam-system-backend
###一个php + mysql 实现在线考试系统后端 前端用vue写的 项目实现前后端分离 前台用axios向后端请求，php返回json数据给前端渲染


php课程设计，做了一个在线考试系统，该系统为了2个，一个是学生端的在线考试，一个是教师端的后台管理,这里是2个端共同使用的php后端项目

前端地址
 -  [vue-exam-system-student](https://github.com/zwStar/vue-exam-system-student)  
 -  [vue-exam-system-teacher](https://github.com/zwStar/vue-exam-system-teacher) 



#### 项目总功能
- 增加学生
- 编辑学生
- 学生成绩
- 新增题库
- 安排考试
- 批改试卷(自动批改选择题，判断题，手动批改填空题)
- 查看某次考试总体成绩分布
- 添加老师
- 编辑老师
- 在线考试
- 查询考试列表
- 成绩查询

## 开发 
```bash
    #我用的是WAMP 把项目的system目录拷贝到wamp的www目录下,启动wamp即可(如果自己本地mysql加密码，需要到system/exam_system_student/db/connect_sql.php 和system/exam_system_teacher/db/connect_sql.php修改密码参数)
    
然后启动前台项目 即可访问
```


## License

MIT