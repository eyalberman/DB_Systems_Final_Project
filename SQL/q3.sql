SELECT venueName, venueAddress, venueURL
FROM Venues 
JOIN VenueToCategory ON VenueToCategory.venueID = Venues.venueID
JOIN Category ON VenueToCategory.categoryID = Category.categoryID
JOIN Tips ON Tips.venueID = Venues.venueID
WHERE Category.isEvening = 1 -- switch to varaiable
AND Category.isNoon = 0 -- switch to varaiable
AND Category.isMorning = 0 -- switch to varaiable
AND INSTR(Tips.tipText,'beer') -- switch to varaiable
GROUP BY venueName