-- categories
INSERT INTO categories (id, name) VALUES ('1', 'level1');
INSERT INTO categories (id, name) VALUES ('2', 'level2');
INSERT INTO categories (id, name) VALUES ('3', 'level3');
INSERT INTO categories (id, name) VALUES ('4', 'level4');
INSERT INTO categories (id, name) VALUES ('5', 'level5');

--courses
INSERT INTO courses (id, category_id, file, title) VALUES ('1', '1', 'sample.md', 'インシデント発生時の報告方法');
INSERT INTO courses (id, category_id, file, title) VALUES ('2', '1', 'security.md', '入館証の取り扱いについて');

--progress
INSERT INTO progress (id, user_id, course_id, done) VALUES ('1', '1', '1','1');
INSERT INTO progress (id, user_id, course_id, done) VALUES ('2', '1', '2','0');


-- SQL
SELECT courses.title, courses.file, progress.done
FROM categories
LEFT JOIN courses
ON categories.id = courses.category_id
LEFT JOIN progress
ON courses.id = progress.course_id
WHERE categories.name = 'level1'
AND progress.user_id = '1'


-- 追加
INSERT INTO courses (id, category_id, file, title) VALUES ('3', '2', 'sample.md', '当社のシステム利用について');
INSERT INTO courses (id, category_id, file, title) VALUES ('4', '2', 'kenshu.md', 'ベンダーの研修制度について');
INSERT INTO courses (id, category_id, file, title) VALUES ('5', '3', 'sample.md', '勤怠管理システムの利用について');