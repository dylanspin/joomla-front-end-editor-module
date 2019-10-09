CREATE TABLE
IF NOT EXISTS `#__frontend_article_editor`
(
    `id`        int(11)         NOT NULL AUTO_INCREMENT,
    `title`     varchar(255)    NOT NULL,
    `text`      varchar(255)    NOT NULL,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `#__frontend_article_editor` (`title`,`text`) VALUES ('Title', 'Text');