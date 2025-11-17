DELIMITER $$

CREATE FUNCTION levenshtein(s1 VARCHAR(255), s2 VARCHAR(255))
RETURNS INT
DETERMINISTIC
BEGIN
    DECLARE s1_len, s2_len, i, j, c, c_temp INT;
    DECLARE cost INT;
    DECLARE s1_char CHAR(1);
    DECLARE cv0, cv1 VARBINARY(256);

    SET s1_len = CHAR_LENGTH(s1);
    SET s2_len = CHAR_LENGTH(s2);
    IF s1_len = 0 THEN
        RETURN s2_len;
    ELSEIF s2_len = 0 THEN
        RETURN s1_len;
    END IF;

    SET cv1 = 0x00;
    SET j = 1;
    WHILE j <= s2_len DO
        SET cv1 = CONCAT(cv1, CHAR(j));
        SET j = j + 1;
    END WHILE;

    SET i = 1;
    WHILE i <= s1_len DO
        SET cv0 = CHAR(i);
        SET s1_char = SUBSTRING(s1, i, 1);
        SET j = 1;
        WHILE j <= s2_len DO
            SET cost = IF(s1_char = SUBSTRING(s2, j, 1), 0, 1);
            SET c = ORD(SUBSTRING(cv1, j, 1)) + 1;
            SET c_temp = ORD(SUBSTRING(cv0, j, 1)) + 1;
            IF c > c_temp THEN SET c = c_temp; END IF;
            SET c_temp = ORD(SUBSTRING(cv1, IF(j = 1, j, j - 1), 1)) + cost;
            IF c > c_temp THEN SET c = c_temp; END IF;
            SET cv0 = INSERT(cv0, j, 1, CHAR(c));
            SET j = j + 1;
        END WHILE;
        SET cv1 = cv0;
        SET i = i + 1;
    END WHILE;
    RETURN c;
END$$

DELIMITER ;

SELECT a.cli_id, a.cli_nom AS nom1,
       b.cli_id, b.cli_nom AS nom2,
       levenshtein(a.cli_nom, b.cli_nom) AS distance
FROM bav_client a
JOIN  bav_client b
  ON a.cli_id < b.cli_id
 AND levenshtein(a.cli_nom, b.cli_nom) <= 5
ORDER BY distance;
