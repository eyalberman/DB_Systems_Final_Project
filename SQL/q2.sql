SELECT a.venueName, a.venueAddress, a.venueURL, a.venueRating
FROM (
	SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.venueRating
	FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
) as a
JOIN (
    select count(*) total_rows
    FROM (
		SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.venueRating
		FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
	) as t1
) as b
WHERE (
    select count(*) 
    FROM (
		SELECT Venues.venueName, Venues.venueAddress, Venues.venueURL, Venues.venueRating
		FROM Venues INNER JOIN Cities ON Venues.cityID = Cities.cityID and Cities.cityDesc = "Berlin" -- switch to varaiable
    ) as c
    WHERE c.venueRating >= a.venueRating
) / total_rows <= .2
ORDER BY a.venueRating DESC