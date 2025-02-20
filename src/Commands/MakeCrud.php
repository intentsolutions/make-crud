<?php

namespace IS\CrudMaker\Commands;

use IS\CrudMaker\Maker\Interfaces\PropertyContainerInterface;
use IS\CrudMaker\Maker\Maker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;

class MakeCrud extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new CRUD';

    private array $data;

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(PropertyContainerInterface $propertyContainer)
    {
        $entity = $this->ask('Entity:', 'Product');
        $propertyContainer->setProperty('entity', $entity);

        $entityPlural = $this->ask('Entity plural:', 'Products');
        $propertyContainer->setProperty('entityPlural', $entityPlural);

        $templateName = $this->ask('Template (Api or Default):', 'Api');
        $propertyContainer->setProperty('templateName', $templateName);

        App::make(Maker::class)->make();
    }
}

