<?php
declare(strict_types=1);

/**
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace Migrations\Command;

/**
 * Trait needed for all "snapshot" type of bake operations.
 * Snapshot type operations are : baking a snapshot and baking a diff.
 */
trait SnapshotTrait
{
    /**
     * After a file has been successfully created, we mark the newly
     * created migration as applied
     *
     * @param string $path Where to put the file.
     * @param string $contents Content to put in the file.
     * @return bool Success
     */
    public function createFile(string $path, string $contents): bool
    {
        $createFile = parent::createFile($path, $contents);

        if ($createFile) {
            $this->markSnapshotApplied($path);

            if (!isset($this->params['no-lock']) || !$this->params['no-lock']) {
                $this->refreshDump();
            }
        }

        return $createFile;
    }

    /**
     * Will mark a snapshot created, the snapshot being identified by its
     * full file path.
     *
     * @param string $path Path to the newly created snapshot
     * @return void
     */
    protected function markSnapshotApplied($path)
    {
        $fileName = pathinfo($path, PATHINFO_FILENAME);
        [$version, ] = explode('_', $fileName, 2);

        $args = [];
        $args[] = '-t';
        $args[] = $version;
        $args[] = '-o';
        if (!empty($this->params['connection'])) {
            $args[] = '-c';
            $args[] = $this->params['connection'];
        }

        if (!empty($this->params['plugin'])) {
            $args[] = '-p';
            $args[] = $this->params['plugin'];
        }

        $this->_io->out('Marking the migration ' . $fileName . ' as migrated...');
        $command = new MigrationsMarkMigratedCommand();
        $command->run($args, $this->_io);
    }

    /**
     * After a file has been successfully created, we refresh the dump of the database
     * to be able to generate a new diff afterward.
     *
     * @return void
     */
    protected function refreshDump()
    {
        $args = [];
        if (!empty($this->params['connection'])) {
            $args[] = '-c';
            $args[] = $this->params['connection'];
        }

        if (!empty($this->params['plugin'])) {
            $args[] = '-p';
            $args[] = $this->params['plugin'];
        }

        $this->_io->out('Creating a dump of the new database state...');
        $command = new MigrationsDumpCommand();
        $command->run($args, $this->_io);
    }
}
