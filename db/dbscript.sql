-- MySQL Script generated by MySQL Workbench
-- Fri Nov  4 11:58:19 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema olhaspotsdb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema olhaspotsdb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `olhaspotsdb` DEFAULT CHARACTER SET utf8 ;
USE `olhaspotsdb` ;

-- -----------------------------------------------------
-- Table `olhaspotsdb`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(80) NOT NULL,
  `mail` VARCHAR(100) NOT NULL,
  `pass` VARCHAR(120) NOT NULL COMMENT 'min: 8\nmax: 25',
  `dataJoin` DATETIME NOT NULL,
  `nivel` INT ZEROFILL NOT NULL COMMENT '0 - User\n1 - Post Mod\n2 - Admin\n3 - Full Admin',
  `pfp` VARCHAR(200) NULL DEFAULT 'default.png',
  `telemovel` VARCHAR(15) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`tiers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`tiers` (
  `token` INT NOT NULL,
  `user_id` INT NOT NULL,
  `dataStart` DATETIME NOT NULL,
  `dataEnd` DATETIME NOT NULL,
  `tier` SMALLINT NOT NULL COMMENT '0 - Sem Tier\n1 - Cavalo Marinho\n2 - Camaleão\n3 - Cegonha',
  PRIMARY KEY (`token`, `user_id`),
  INDEX `fk_tiers_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_tiers_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `olhaspotsdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`estabelecimentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`estabelecimentos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `token` INT NOT NULL,
  `nome` VARCHAR(80) NOT NULL,
  `morada` VARCHAR(200) NULL,
  `codigoPostal` VARCHAR(25) NULL,
  `mail` VARCHAR(100) NULL,
  `msg` TEXT NULL,
  `logo` VARCHAR(200) NULL DEFAULT 'default.png',
  `banner` VARCHAR(200) NULL DEFAULT 'default.png',
  `views` INT NULL,
  `viewsLast` INT NULL,
  `favLast` INT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_estabelecimentos_tiers1_idx` (`token` ASC),
  CONSTRAINT `fk_estabelecimentos_tiers1`
    FOREIGN KEY (`token`)
    REFERENCES `olhaspotsdb`.`tiers` (`token`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`contactos_tel`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`contactos_tel` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estabelecimento_id` INT NOT NULL,
  `numero` VARCHAR(15) NOT NULL,
  `desc` VARCHAR(80) NULL,
  `categoria` SMALLINT NOT NULL DEFAULT 0 COMMENT '0 - telemovel\n1 - telefone\n2 - fax',
  PRIMARY KEY (`id`),
  INDEX `fk_telefone_estabelecimento_idx` (`estabelecimento_id` ASC),
  CONSTRAINT `fk_telefone_estabelecimento`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `olhaspotsdb`.`estabelecimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`categorias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`categorias` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`categorias_estab`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`categorias_estab` (
  `estab_id` INT NOT NULL,
  `categorias_id` INT NOT NULL,
  PRIMARY KEY (`estab_id`, `categorias_id`),
  INDEX `fk_estabelecimentos_has_categorias_categorias1_idx` (`categorias_id` ASC),
  INDEX `fk_estabelecimentos_has_categorias_estabelecimentos1_idx` (`estab_id` ASC),
  CONSTRAINT `fk_estabelecimentos_has_categorias_estabelecimentos1`
    FOREIGN KEY (`estab_id`)
    REFERENCES `olhaspotsdb`.`estabelecimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estabelecimentos_has_categorias_categorias1`
    FOREIGN KEY (`categorias_id`)
    REFERENCES `olhaspotsdb`.`categorias` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`user_fav_estab`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`user_fav_estab` (
  `user_id` INT NOT NULL,
  `estabelecimento_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  PRIMARY KEY (`user_id`, `estabelecimento_id`),
  INDEX `fk_estabelecimentos_has_users_users1_idx` (`user_id` ASC),
  INDEX `fk_estabelecimentos_has_users_estabelecimentos1_idx` (`estabelecimento_id` ASC),
  CONSTRAINT `fk_estabelecimentos_has_users_estabelecimentos1`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `olhaspotsdb`.`estabelecimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estabelecimentos_has_users_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `olhaspotsdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`produtos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `estabelecimentos_id` INT NOT NULL,
  `nome` VARCHAR(140) NOT NULL,
  `preco` FLOAT NOT NULL,
  PRIMARY KEY (`id`, `estabelecimentos_id`),
  INDEX `fk_produtos_estabelecimentos1_idx` (`estabelecimentos_id` ASC),
  CONSTRAINT `fk_produtos_estabelecimentos1`
    FOREIGN KEY (`estabelecimentos_id`)
    REFERENCES `olhaspotsdb`.`estabelecimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `olhaspotsdb`.`estab_users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `olhaspotsdb`.`estab_users` (
  `estabelecimento_id` INT NOT NULL,
  `user_id` INT NOT NULL,
  `nivel` INT NOT NULL,
  `dataJoin` DATETIME NULL,
  `dataLeft` DATETIME NULL,
  PRIMARY KEY (`estabelecimento_id`, `user_id`),
  INDEX `fk_estabelecimentos_has_users_users2_idx` (`user_id` ASC),
  INDEX `fk_estabelecimentos_has_users_estabelecimentos2_idx` (`estabelecimento_id` ASC),
  CONSTRAINT `fk_estabelecimentos_has_users_estabelecimentos2`
    FOREIGN KEY (`estabelecimento_id`)
    REFERENCES `olhaspotsdb`.`estabelecimentos` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estabelecimentos_has_users_users2`
    FOREIGN KEY (`user_id`)
    REFERENCES `olhaspotsdb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
