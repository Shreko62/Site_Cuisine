<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190905140241 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('DROP INDEX IDX_43B9FE3C59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, recipe_id, place, instruction FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, place INTEGER NOT NULL, instruction CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_43B9FE3C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO step (id, recipe_id, place, instruction) SELECT id, recipe_id, place, instruction FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
        $this->addSql('DROP INDEX IDX_794381C659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, recipe_id, pseudo, commentary, note FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, pseudo VARCHAR(40) NOT NULL COLLATE BINARY, commentary CLOB NOT NULL COLLATE BINARY, note INTEGER NOT NULL, CONSTRAINT FK_794381C659D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO review (id, recipe_id, pseudo, commentary, note) SELECT id, recipe_id, pseudo, commentary, note FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('DROP INDEX IDX_39D44F7C87FE4635');
        $this->addSql('DROP INDEX IDX_39D44F7C59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_cook_tool AS SELECT recipe_id, cook_tool_id FROM recipe_cook_tool');
        $this->addSql('DROP TABLE recipe_cook_tool');
        $this->addSql('CREATE TABLE recipe_cook_tool (recipe_id INTEGER NOT NULL, cook_tool_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, cook_tool_id), CONSTRAINT FK_39D44F7C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_39D44F7C87FE4635 FOREIGN KEY (cook_tool_id) REFERENCES cook_tool (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recipe_cook_tool (recipe_id, cook_tool_id) SELECT recipe_id, cook_tool_id FROM __temp__recipe_cook_tool');
        $this->addSql('DROP TABLE __temp__recipe_cook_tool');
        $this->addSql('CREATE INDEX IDX_39D44F7C87FE4635 ON recipe_cook_tool (cook_tool_id)');
        $this->addSql('CREATE INDEX IDX_39D44F7C59D8A214 ON recipe_cook_tool (recipe_id)');
        $this->addSql('DROP INDEX IDX_22D1FE13933FE08C');
        $this->addSql('DROP INDEX IDX_22D1FE1359D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_ingredient AS SELECT recipe_id, ingredient_id FROM recipe_ingredient');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, ingredient_id), CONSTRAINT FK_22D1FE1359D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_22D1FE13933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recipe_ingredient (recipe_id, ingredient_id) SELECT recipe_id, ingredient_id FROM __temp__recipe_ingredient');
        $this->addSql('DROP TABLE __temp__recipe_ingredient');
        $this->addSql('CREATE INDEX IDX_22D1FE13933FE08C ON recipe_ingredient (ingredient_id)');
        $this->addSql('CREATE INDEX IDX_22D1FE1359D8A214 ON recipe_ingredient (recipe_id)');
        $this->addSql('DROP INDEX IDX_72DED3CFBAD26311');
        $this->addSql('DROP INDEX IDX_72DED3CF59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_tag AS SELECT recipe_id, tag_id FROM recipe_tag');
        $this->addSql('DROP TABLE recipe_tag');
        $this->addSql('CREATE TABLE recipe_tag (recipe_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, tag_id), CONSTRAINT FK_72DED3CF59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_72DED3CFBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO recipe_tag (recipe_id, tag_id) SELECT recipe_id, tag_id FROM __temp__recipe_tag');
        $this->addSql('DROP TABLE __temp__recipe_tag');
        $this->addSql('CREATE INDEX IDX_72DED3CFBAD26311 ON recipe_tag (tag_id)');
        $this->addSql('CREATE INDEX IDX_72DED3CF59D8A214 ON recipe_tag (recipe_id)');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL COLLATE BINARY, quantity INTEGER DEFAULT NULL, CONSTRAINT FK_6BAF7870F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_6BAF7870F8BD700D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__ingredient AS SELECT id, unit_id, name, quantity FROM ingredient');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('CREATE TABLE ingredient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, unit_id INTEGER DEFAULT NULL, name VARCHAR(50) NOT NULL, quantity INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO ingredient (id, unit_id, name, quantity) SELECT id, unit_id, name, quantity FROM __temp__ingredient');
        $this->addSql('DROP TABLE __temp__ingredient');
        $this->addSql('CREATE INDEX IDX_6BAF7870F8BD700D ON ingredient (unit_id)');
        $this->addSql('DROP INDEX IDX_39D44F7C59D8A214');
        $this->addSql('DROP INDEX IDX_39D44F7C87FE4635');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_cook_tool AS SELECT recipe_id, cook_tool_id FROM recipe_cook_tool');
        $this->addSql('DROP TABLE recipe_cook_tool');
        $this->addSql('CREATE TABLE recipe_cook_tool (recipe_id INTEGER NOT NULL, cook_tool_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, cook_tool_id))');
        $this->addSql('INSERT INTO recipe_cook_tool (recipe_id, cook_tool_id) SELECT recipe_id, cook_tool_id FROM __temp__recipe_cook_tool');
        $this->addSql('DROP TABLE __temp__recipe_cook_tool');
        $this->addSql('CREATE INDEX IDX_39D44F7C59D8A214 ON recipe_cook_tool (recipe_id)');
        $this->addSql('CREATE INDEX IDX_39D44F7C87FE4635 ON recipe_cook_tool (cook_tool_id)');
        $this->addSql('DROP INDEX IDX_22D1FE1359D8A214');
        $this->addSql('DROP INDEX IDX_22D1FE13933FE08C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_ingredient AS SELECT recipe_id, ingredient_id FROM recipe_ingredient');
        $this->addSql('DROP TABLE recipe_ingredient');
        $this->addSql('CREATE TABLE recipe_ingredient (recipe_id INTEGER NOT NULL, ingredient_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, ingredient_id))');
        $this->addSql('INSERT INTO recipe_ingredient (recipe_id, ingredient_id) SELECT recipe_id, ingredient_id FROM __temp__recipe_ingredient');
        $this->addSql('DROP TABLE __temp__recipe_ingredient');
        $this->addSql('CREATE INDEX IDX_22D1FE1359D8A214 ON recipe_ingredient (recipe_id)');
        $this->addSql('CREATE INDEX IDX_22D1FE13933FE08C ON recipe_ingredient (ingredient_id)');
        $this->addSql('DROP INDEX IDX_72DED3CF59D8A214');
        $this->addSql('DROP INDEX IDX_72DED3CFBAD26311');
        $this->addSql('CREATE TEMPORARY TABLE __temp__recipe_tag AS SELECT recipe_id, tag_id FROM recipe_tag');
        $this->addSql('DROP TABLE recipe_tag');
        $this->addSql('CREATE TABLE recipe_tag (recipe_id INTEGER NOT NULL, tag_id INTEGER NOT NULL, PRIMARY KEY(recipe_id, tag_id))');
        $this->addSql('INSERT INTO recipe_tag (recipe_id, tag_id) SELECT recipe_id, tag_id FROM __temp__recipe_tag');
        $this->addSql('DROP TABLE __temp__recipe_tag');
        $this->addSql('CREATE INDEX IDX_72DED3CF59D8A214 ON recipe_tag (recipe_id)');
        $this->addSql('CREATE INDEX IDX_72DED3CFBAD26311 ON recipe_tag (tag_id)');
        $this->addSql('DROP INDEX IDX_794381C659D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__review AS SELECT id, recipe_id, pseudo, commentary, note FROM review');
        $this->addSql('DROP TABLE review');
        $this->addSql('CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, pseudo VARCHAR(40) NOT NULL, commentary CLOB NOT NULL, note INTEGER NOT NULL)');
        $this->addSql('INSERT INTO review (id, recipe_id, pseudo, commentary, note) SELECT id, recipe_id, pseudo, commentary, note FROM __temp__review');
        $this->addSql('DROP TABLE __temp__review');
        $this->addSql('CREATE INDEX IDX_794381C659D8A214 ON review (recipe_id)');
        $this->addSql('DROP INDEX IDX_43B9FE3C59D8A214');
        $this->addSql('CREATE TEMPORARY TABLE __temp__step AS SELECT id, recipe_id, place, instruction FROM step');
        $this->addSql('DROP TABLE step');
        $this->addSql('CREATE TABLE step (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipe_id INTEGER NOT NULL, place INTEGER NOT NULL, instruction CLOB NOT NULL)');
        $this->addSql('INSERT INTO step (id, recipe_id, place, instruction) SELECT id, recipe_id, place, instruction FROM __temp__step');
        $this->addSql('DROP TABLE __temp__step');
        $this->addSql('CREATE INDEX IDX_43B9FE3C59D8A214 ON step (recipe_id)');
    }
}
