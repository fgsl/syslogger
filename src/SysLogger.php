<?php
/**
 * Fgsl Syslogger
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br>
 * @copyright FGSL 2021
 * @license GNU Affero General Public License v3.0
 */
namespace Fgsl\Log;

use Laminas\Log\Logger;
use Laminas\Log\Writer\Syslog;
use Laminas\Log\Formatter\Simple;
use Laminas\Log\Writer\Stream;

final class SysLogger
{

    private static ?SysLogger $instance = null;

    private $syslog;

    private function __construct(?WriterInterface $writer = null)
    {
        $writer = (is_null($writer) ? new Stream('php://stderr') : $writer);
        $this->syslog = new Logger();
        $this->syslog->addWriter($writer);
    }

    public static function getInstance(?WriterInterface $writer = null)
    {
        if (self::$instance == null) {
            self::$instance = new SysLogger($writer);
        }
        return self::$instance;
    }

    /**
     *
     * @param string $method
     * @param array $args
     *            [0] message [1] label
     */
    public function __call(string $method, array $args)
    {
        $args[1] = (isset($args[1]) ? $args[1] : 'Label was not defined');
        $message = $args[1] . ' - ' . $args[0];
        $this->syslog->$method($message);
    }
}