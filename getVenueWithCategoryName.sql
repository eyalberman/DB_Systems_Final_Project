	SELECT venueName, venueAddress, venueURL, z.categoryID, categoryDesc
	FROM Venues x
	INNER JOIN VenueToCategory z ON z.venueID = x.venueID
    INNER JOIN Category c ON c.categoryID = z.categoryID

