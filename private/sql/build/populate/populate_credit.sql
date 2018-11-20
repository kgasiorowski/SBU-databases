-- Add some credits, linking the two tables together
INSERT INTO credit (personnelID, filmID, roleID) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    (SELECT ID FROM role WHERE role="Actor")

),
(

    (SELECT ID FROM personnel WHERE firstname="Leonardo"),
    (SELECT ID FROM film WHERE title="Inception"),
    (SELECT ID FROM role WHERE role="Actor")

),
(

    (SELECT ID FROM personnel WHERE firstname="Jim"),
    (SELECT ID FROM film WHERE title="The Truman Show"),
    (SELECT ID FROM role WHERE role="Actor")

),
(

    (SELECT ID FROM personnel WHERE firstname="Christopher"),
    (SELECT ID FROM film WHERE title="Inception"),
    (SELECT ID FROM role WHERE role="Director")

),
(

    (SELECT ID FROM personnel WHERE firstname="Ellen"),
    (SELECT ID FROM film WHERE title="Inception"),
    (SELECT ID FROM role WHERE role="Actor")

),
(

    (SELECT ID FROM personnel WHERE firstname="Tom"),
    (SELECT ID FROM film WHERE title="Cast Away"),
    (SELECT ID FROM role WHERE role="Actor")

),
(

    (SELECT ID FROM personnel WHERE firstname="Ron"),
    (SELECT ID FROM film WHERE title="Apollo 13"),
    (SELECT ID FROM role WHERE role="Director")

)

;
