CREATE TABLE album (
					id_album	INT,
					isbn		VARCHAR(36),
					art_url		VARCHAR(64),
					artist		VARCHAR(64),
					album		VARCHAR(64),
					relyear		INT,
					description	TEXT,
					CONSTRAINT pk_album PRIMARY KEY (id_album)
				);