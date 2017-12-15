#list all players
Delimiter //
DROP PROCEDURE IF EXISTS AllPlayers //
CREATE PROCEDURE AllPlayers(IN passwordInput VARCHAR(20))
BEGIN
IF (passwordInput IN (SELECT curpasswords FROM Passwords)) THEN
	SELECT *
	FROM Player
	ORDER BY Name;
ELSE
	SELECT 'The password you entered is wrong. Please contact the administrator for access to the Fifa database' AS Error_Message;
END IF;
END //
Delimiter ;