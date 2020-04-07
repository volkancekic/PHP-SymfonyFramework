<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181226181352 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, parentid INT NOT NULL, title VARCHAR(30) NOT NULL, keywords VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, status VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, image VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages2 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, subject VARCHAR(100) DEFAULT NULL, message VARCHAR(255) DEFAULT NULL, comment VARCHAR(100) DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) DEFAULT NULL, keywords VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(20) DEFAULT NULL, publisher_id INT DEFAULT NULL, year INT DEFAULT NULL, amount INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, sprice DOUBLE PRECISION DEFAULT NULL, min INT DEFAULT NULL, detail LONGTEXT DEFAULT NULL, image VARCHAR(150) DEFAULT NULL, writer_id INT DEFAULT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, keywords VARCHAR(255) DEFAULT NULL, company VARCHAR(255) DEFAULT NULL, address VARCHAR(255) DEFAULT NULL, fax VARCHAR(15) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, email VARCHAR(50) DEFAULT NULL, smtpserver VARCHAR(100) DEFAULT NULL, smtpemail VARCHAR(50) DEFAULT NULL, smtppassw VARCHAR(20) DEFAULT NULL, smtpport INT DEFAULT NULL, aboutus LONGTEXT DEFAULT NULL, contact LONGTEXT DEFAULT NULL, referances LONGTEXT DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles VARCHAR(50) DEFAULT NULL, password VARCHAR(255) NOT NULL, name VARCHAR(20) DEFAULT NULL, status VARCHAR(10) DEFAULT NULL, address VARCHAR(150) DEFAULT NULL, city VARCHAR(25) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopcart (id INT AUTO_INCREMENT NOT NULL, userid INT DEFAULT NULL, productid INT DEFAULT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE order_detail (id INT AUTO_INCREMENT NOT NULL, orderid INT DEFAULT NULL, userid INT DEFAULT NULL, productid INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, quantity INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, name VARCHAR(150) DEFAULT NULL, status VARCHAR(15) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, userid INT DEFAULT NULL, amount DOUBLE PRECISION DEFAULT NULL, name VARCHAR(25) DEFAULT NULL, address VARCHAR(150) DEFAULT NULL, city VARCHAR(15) DEFAULT NULL, phone VARCHAR(15) DEFAULT NULL, shipinfo VARCHAR(255) DEFAULT NULL, status VARCHAR(15) DEFAULT NULL, note VARCHAR(250) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, created_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL, email VARCHAR(50) NOT NULL, password VARCHAR(255) NOT NULL, type VARCHAR(10) NOT NULL, status VARCHAR(10) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE category1');
        $this->addSql('DROP TABLE image1');
        $this->addSql('DROP TABLE messages21');
        $this->addSql('DROP TABLE product1');
        $this->addSql('DROP TABLE setting1');
        $this->addSql('DROP TABLE shopcart1');
        $this->addSql('DROP TABLE user1');
        $this->addSql('DROP TABLE users1');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE category1 (id INT AUTO_INCREMENT NOT NULL, parentid INT NOT NULL, title VARCHAR(30) NOT NULL COLLATE utf8mb4_unicode_ci, keywords VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image1 (id INT AUTO_INCREMENT NOT NULL, product_id INT DEFAULT NULL, image VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messages21 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, subject VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, message VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, comment VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE product1 (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) DEFAULT NULL COLLATE utf8mb4_unicode_ci, keywords VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, publisher_id INT DEFAULT NULL, year INT DEFAULT NULL, amount INT DEFAULT NULL, price DOUBLE PRECISION DEFAULT NULL, sprice DOUBLE PRECISION DEFAULT NULL, min INT DEFAULT NULL, detail LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, image VARCHAR(150) DEFAULT NULL COLLATE utf8mb4_unicode_ci, writer_id INT DEFAULT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, status VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE setting1 (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, description VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, keywords VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, company VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, address VARCHAR(255) DEFAULT NULL COLLATE utf8mb4_unicode_ci, fax VARCHAR(15) DEFAULT NULL COLLATE utf8mb4_unicode_ci, phone VARCHAR(15) DEFAULT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, smtpserver VARCHAR(100) DEFAULT NULL COLLATE utf8mb4_unicode_ci, smtpemail VARCHAR(50) DEFAULT NULL COLLATE utf8mb4_unicode_ci, smtppassw VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, smtpport INT DEFAULT NULL, aboutus LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, contact LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, referances LONGTEXT DEFAULT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE shopcart1 (id INT AUTO_INCREMENT NOT NULL, userid INT DEFAULT NULL, productid INT DEFAULT NULL, quantity INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user1 (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL COLLATE utf8mb4_unicode_ci, roles VARCHAR(55) DEFAULT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, name VARCHAR(20) DEFAULT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(10) DEFAULT NULL COLLATE utf8mb4_unicode_ci, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users1 (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(20) NOT NULL COLLATE utf8mb4_unicode_ci, email VARCHAR(50) NOT NULL COLLATE utf8mb4_unicode_ci, password VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, type VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, status VARCHAR(10) NOT NULL COLLATE utf8mb4_unicode_ci, creating_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE messages2');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE setting');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE shopcart');
        $this->addSql('DROP TABLE order_detail');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE users');
    }
}
