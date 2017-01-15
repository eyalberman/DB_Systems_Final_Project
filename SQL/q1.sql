SELECT a.venueName, a.venueAddress, a.venueURL, a.likesCount
FROM (
	SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount
	FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
) as a
JOIN (
    select count(*) total_rows
    FROM (
		SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount
		FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
	) as t1
) as b
WHERE (
    select count(*) 
    FROM (
		SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.likesCount
		FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
    ) as c
    WHERE c.likesCount >= a.likesCount
) / total_rows <= .1
ORDER BY a.likesCount DESC