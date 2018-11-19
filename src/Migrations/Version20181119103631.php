<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181119103631 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE users_posts (user_id INT NOT NULL, post_id INT NOT NULL, INDEX IDX_6F2A1EB3A76ED395 (user_id), UNIQUE INDEX UNIQ_6F2A1EB34B89032C (post_id), PRIMARY KEY(user_id, post_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE users_posts ADD CONSTRAINT FK_6F2A1EB3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE users_posts ADD CONSTRAINT FK_6F2A1EB34B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('DROP TABLE user_post');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user_post (user_id INT NOT NULL, post_id INT NOT NULL, UNIQUE INDEX post_id (post_id), INDEX IDX_200B2044A76ED395 (user_id), INDEX IDX_200B20444B89032C (post_id), PRIMARY KEY(user_id, post_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_post ADD CONSTRAINT FK_200B20444B89032C FOREIGN KEY (post_id) REFERENCES post (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_post ADD CONSTRAINT FK_200B2044A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE users_posts');
    }
}
