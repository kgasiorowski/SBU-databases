INSERT INTO edit(article_ID, old_title, new_title, old_body, new_body, userID, approved_by_admin_ID, time_of_approval) VALUES 
(
    1, 'Test old title', 'Test new title', 'Test old body', 'Test new body', 1, 1, NOW()
);

INSERT INTO edit(article_ID, old_title, new_title, old_body, new_body, userID, approved_by_admin_ID, time_of_approval) VALUES 
(
    2, 'Test old title', 'Test new title', 'Test old body', 'Test new body', 2, NULL, NULL
);
