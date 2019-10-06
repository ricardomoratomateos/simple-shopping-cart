<?php
namespace Uvinum\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class UpdateCurrencyValuesCommand extends Command
{
    const CURRENCY_VALUES_WEB = 'https://www.ecb.europa.eu/stats/policy_and_exchange_rates/euro_reference_exchange_rates/html/index.en.html';
    
    protected static $defaultName = "app:update-currency-values";

    /** @var HttpClientInterface $client */
    private $client;

    /** @var Crawler $crawler */
    private $crawler;

    public function __construct(
        HttpClientInterface $client,
        Crawler $crawler
    ) {
        $this->client = $client;
        $this->crawler = $crawler;

        parent::__construct();
    }

    protected function configure()
    {
        $description = "Update the values of the currencies in database.";
        $this
            ->setDescription($description)
            ->setHelp($description)
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("\n\nGetting results ...\n\n");
        
        $response = $this->client->request('GET', self::CURRENCY_VALUES_WEB);
        $this->crawler->add($response->getContent());

        $values = $this->crawler
            ->filter(".forextable tbody")
            ->children()
            ->each(function (Crawler $node, $i) {
                $currency = $node->filter(".currency")->text();
                $value = $node->filter(".rate")->text();

                return $currency . " = " . $value;
            });
        $output->writeln($values);

        $output->writeln("\n\n<fg=green>Done!</>\n\n");
    }
}
