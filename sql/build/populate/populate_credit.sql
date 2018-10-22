-- Add some credits, linking the two tables together
INSERT INTO credit (personnel_ID, film_ID, role) VALUES
(
    (SELECT ID FROM personnel WHERE firstname="Tom"), 
    (SELECT ID FROM film WHERE title="Apollo 13"), 
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Leonardo"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Jim"),
    (SELECT ID FROM film WHERE title="The Truman Show"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Christopher"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Director"

),
(

    (SELECT ID FROM personnel WHERE firstname="Ellen"),
    (SELECT ID FROM film WHERE title="Inception"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Tom"),
    (SELECT ID FROM film WHERE title="Cast Away"),
    "Actor"

),
(

    (SELECT ID FROM personnel WHERE firstname="Ron"),
    (SELECT ID FROM film WHERE title="Apollo 13"),
    "Director"

)

;
