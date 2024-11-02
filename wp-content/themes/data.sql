-- Đảm bảo rằng bạn đang ở đúng cơ sở dữ liệu
USE hiendb;

-- Bắt đầu giao dịch
START TRANSACTION;

-- Xóa nếu có các bài viết trùng ID
DELETE FROM wp_posts WHERE ID >= 1000000;

-- Khởi tạo ID bài viết để không xung đột với các bài viết hiện có
SET @id = 1000000;

-- Xóa thủ tục nếu đã tồn tại trước đó
DROP PROCEDURE IF EXISTS GeneratePosts;

-- Xóa dữ liệu danh mục nếu đã có từ trước
DELETE FROM wp_terms WHERE term_id >= 1000;
DELETE FROM wp_term_taxonomy WHERE term_taxonomy_id >= 1000;

-- Tạo một số danh mục mẫu vào bảng wp_terms và wp_term_taxonomy
INSERT INTO wp_terms (term_id, name, slug, term_group) VALUES 
(1000, 'Danh mục 1', 'danh-muc-1', 0),
(1001, 'Danh mục 2', 'danh-muc-2', 0),
(1002, 'Danh mục 3', 'danh-muc-3', 0),
(1003, 'Danh mục 4', 'danh-muc-4', 0),
(1004, 'Danh mục 5', 'danh-muc-5', 0),
(1005, 'Danh mục 6', 'danh-muc-6', 0),
(1006, 'Danh mục 7', 'danh-muc-7', 0),
(1007, 'Danh mục 8', 'danh-muc-8', 0),
(1008, 'Danh mục 9', 'danh-muc-9', 0),
(1009, 'Danh mục 10', 'danh-muc-10', 0);

INSERT INTO wp_term_taxonomy (term_taxonomy_id, term_id, taxonomy, description, parent, count) VALUES 
(1000, 1000, 'category', '', 0, 0),
(1001, 1001, 'category', '', 0, 0),
(1002, 1002, 'category', '', 0, 0),
(1003, 1003, 'category', '', 0, 0),
(1004, 1004, 'category', '', 0, 0),
(1005, 1005, 'category', '', 0, 0),
(1006, 1006, 'category', '', 0, 0),
(1007, 1007, 'category', '', 0, 0),
(1008, 1008, 'category', '', 0, 0),
(1009, 1009, 'category', '', 0, 0),
(10010, 10010, 'category', '', 0, 0);

-- Tạo thủ tục cho vòng lặp tạo 10.000 bài viết mẫu với thời gian và danh mục ngẫu nhiên
DELIMITER $$

CREATE PROCEDURE GeneratePosts()
BEGIN
    DECLARE i INT DEFAULT 1;
    
    WHILE i <= 10000 DO
        -- Tạo thời gian ngẫu nhiên từ 2020 đến hiện tại
        SET @random_days = FLOOR(RAND() * 365 * 4); -- Khoảng 4 năm (từ 2020 đến nay)
        SET @random_date = DATE_ADD('2020-01-01', INTERVAL @random_days DAY);
        
        -- Tạo bài viết vào bảng wp_posts
        INSERT INTO wp_posts 
        (ID, post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, post_name, post_type) 
        VALUES 
        (
            @id,
            1, 
            @random_date, 
            @random_date, 
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
            CONCAT('Bài viết mẫu số ', i), 
            '', 
            'publish', 
            CONCAT('bai-viet-mau-so-', i), 
            'post'
        );

        -- Gán ngẫu nhiên bài viết vào một danh mục trong wp_term_relationships
        SET @random_category = 1000 + FLOOR(RAND() * 10); -- Chọn ngẫu nhiên một danh mục từ 1000 đến 1003
        INSERT INTO wp_term_relationships (object_id, term_taxonomy_id, term_order) 
        VALUES (@id, @random_category, 0);

        -- Tăng bộ đếm của danh mục
        UPDATE wp_term_taxonomy SET count = count + 1 WHERE term_taxonomy_id = @random_category;

        -- Tăng ID và biến lặp
        SET @id = @id + 1;
        SET i = i + 1;
    END WHILE;
END$$

DELIMITER ;

-- Gọi thủ tục để thực thi vòng lặp
CALL GeneratePosts();

-- Kết thúc giao dịch và lưu thay đổi
COMMIT;
