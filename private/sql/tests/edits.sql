use imdbc;

/*(
SELECT e1.article_ID, MAX(e1.time_of_edit) AS latest_edit_time
FROM editv e1
GROUP BY article_ID
)*/	

select e1.*/*, e2.maxdate*/
from editv e1
inner join
(
  select max(time_of_edit) maxdate, article_ID
  from editv
  group by article_ID
) e2
  on e1.article_ID = e2.article_ID
  and e1.time_of_edit = e2.maxdate

