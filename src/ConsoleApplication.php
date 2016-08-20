<?php
/**
 * This file is part of Google Sitemap generator.
 *
 * (c) 2016 Daniele Moraschi
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GoogleSiteMapGenerator;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class ConsoleApplication extends Command
{
    const NAME = "generate";

    const DESC = "This will crawl all unique internal links found on a given website <info>url</info> and generate a Google sitemap XML file.";

    /**
     * Configures the current command.
     */
    protected function configure() {
        $this->setName(self::NAME)
           ->setDescription(self::DESC)
           ->setDefinition(array(
               new InputOption('url', 'u', InputOption::VALUE_REQUIRED, 'The website url to scan. This is mandatory.'),
               new InputOption('deep', 'd', InputOption::VALUE_OPTIONAL, 'Follow link deep.', 1),
               new InputOption('priority', 'p', InputOption::VALUE_OPTIONAL, 'Web page priority.', 0.3),
               new InputOption('frequency', 'f', InputOption::VALUE_OPTIONAL, 'Web page frequency.', 'daily'),
               new InputOption('output', 'o', InputOption::VALUE_OPTIONAL, 'The output filename.', 'sitemap.xml'),
           ))
           ->setHelp(self::DESC);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return mixed
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $urlValue = $input->getOption('url');
        $deepValue = $input->getOption('deep');
        $priorityValue = $input->getOption('priority');
        $frequencyValue = $input->getOption('frequency');
        $filenameValue = $input->getOption('output');

        if (empty($urlValue)) {
            throw new InvalidArgumentException("Please provide URL to scan.");
        }

        $service = new GoogleSiteMapGeneratorService();

        return $service->execute($urlValue, $deepValue, $priorityValue, $frequencyValue, $filenameValue);
    }
    
}
