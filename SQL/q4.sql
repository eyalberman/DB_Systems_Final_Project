
SELECT Cities.cityDesc, avg(Venues.likesCount) as averageLikes, avg(Venues.venueRating) as averageRating
FROM Cities
JOIN Venues ON Venues.cityID = Cities.cityID
JOIN VenueToCategory ON VenueToCategory.venueID = Venues.venueID
JOIN Category ON VenueToCategory.categoryID = Category.categoryID
WHERE Category.CategoryMaster = 'Food' -- switch to varaiable
GROUP BY Cities.cityDesc
ORDER BY avg(Venues.likesCount)*0.01 + avg(Venues.venueRating)*0.99 DESC
LIMIT 1;