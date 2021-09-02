<?php
use Fgsl\Log\SysLogger;

/**
 * Fgsl Syslogger
 * @author Flávio Gomes da Silva Lisboa <flavio.lisboa@fgsl.eti.br>
 * @copyright FGSL 2021
 * @license GNU Affero General Public License v3.0
 */
class SysloggerTest extends PHPUnit\Framework\TestCase
{
    /**
     * @covers Syslogger
     */
    public function testSysLogger()
    {
        $sysLogger = SysLogger::getInstance();
        
        $sysLogger->debug('Debug test', __METHOD__);
        $sysLogger->info('Info test');
        $sysLogger->notice('Notice test');
        $sysLogger->warn('Warning test');
        $sysLogger->err('Error test');
        $sysLogger->crit('Critical test');
        $sysLogger->alert('Alert test');
        
        $this->assertIsObject($sysLogger);        
    }
}

