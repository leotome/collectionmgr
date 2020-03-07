/*
 * Application name: Collection Manager
 * Author: Leonardo Tomé - leonardo@gmx.pt
 * Version 1.0
 *
 * SQL Script: create.sql
*/


CREATE TABLE media_type (
						id_type 	INT,
						type_name 	VARCHAR(32),
						CONSTRAINT pk_mtype PRIMARY KEY (id_type)
);

CREATE TABLE recordlabels (
						id_label 	INT,
						label_name 	VARCHAR(32),
						CONSTRAINT pk_mlbl PRIMARY KEY (id_label)
);


CREATE TABLE albums (
					id 				VARCHAR(32),
					artist  		VARCHAR(64),
					album 			VARCHAR(64),
					relyear 		INT,
					label 			INT,
					media_type  	INT,
					media_amount    INT,
					CONSTRAINT pk_album PRIMARY KEY (id),
					CONSTRAINT fk_label FOREIGN KEY (label) REFERENCES recordlabels(id_label),
					CONSTRAINT fk_type  FOREIGN KEY (media_type) REFERENCES media_type(id_type)
				);

CREATE TABLE album_track_list (
								album_id    VARCHAR(32),
								cd_number   INT,
								id 			INT,
								track_name	VARCHAR(64),
								CONSTRAINT fk_album FOREIGN KEY (album_id) REFERENCES albums(id)
);
