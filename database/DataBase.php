<?php

namespace database;

use PDO;
use PDOException;

class DataBase
{
    private static $instance = null;
    private $connection;
    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
        PDO::ATTR_PERSISTENT => true
    );
    private $dbHost = DB_HOST;
    private $dbUserName = DB_USERNAME;
    private $dbName = DB_NAME;
    private $dbPassword = DB_PASSWORD;

    private function __construct()
    {
        try {
            // $this->connection = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
            $this->connection = new PDO("mysql:host=" . $this->dbHost . ";port=3306;dbname=" . $this->dbName, $this->dbUserName, $this->dbPassword, $this->options);
        } catch (PDOException $e) {
            echo $e->getMessage();
            exit;
        }
    }

    //Singleton
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new DataBase();
        }
        return self::$instance;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function select($sql, $values = null)
    {
        try {
            $stmt = $this->connection->prepare($sql);
            if ($values == null) {
                $stmt->execute();
            } else {
                $stmt->execute($values);
            }
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getLastAutoIncrementId($tableName)
    {
        try {
            $sql = "SHOW TABLE STATUS LIKE ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tableName]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['Auto_increment'];
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getLastId($tableName)
    {
        try {
            $sql = "SELECT AUTO_INCREMENT FROM information_schema.tables WHERE table_name = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$tableName]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                return $result['AUTO_INCREMENT'] - 1;
            } else {
                return null;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function insert($tableName, $fields, $values)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO " . $tableName . "(" . implode(', ', $fields) . " , created_at) VALUES ( :" . implode(', :', $fields) . " , now() );");
            $stmt->execute(array_combine($fields, $values));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update($tableName, $id, $fields, $values)
    {
        $sql = "UPDATE " . $tableName . " SET";
        foreach (array_combine($fields, $values) as $field => $value) {
            if ($value) {
                $sql .= " `" . $field . "` = ? ,";
            } else {
                $sql .= " `" . $field . "` = NULL ,";
            }
        }

        $sql .= " updated_at = now()";
        $sql .= " WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_filter(array_values($values)), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    // update scores
    public function updateScore($tableName, $id, $fields, $values)
    {
        $sql = "UPDATE " . $tableName . " SET";
        foreach (array_combine($fields, $values) as $field => $value) {
            if (empty($value) && $value !== "0") {
                // مقدار خالی تبدیل به 0.00 می‌شود
                $value = 0.00;
            }
            $sql .= " `" . $field . "` = ? ,";
        }

        $sql .= " updated_at = now()";
        $sql .= " WHERE id = ?";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute(array_merge(array_values($values), [$id]));
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete($tableName, $id)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE id = ? ;";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function deleteWhere($tableName, $columnName, $value)
    {
        $sql = "DELETE FROM " . $tableName . " WHERE " . $columnName . " = ? ;";
        try {
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$value]);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function createTable($sql)
    {
        try {
            $this->connection->exec($sql);
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollBack()
    {
        return $this->connection->rollBack();
    }

    // get sys infos
    function getSysh(): string
    {
        $cpu = @shell_exec('wmic cpu get ProcessorId 2>NUL');
        $hdd = @shell_exec('wmic diskdrive get SerialNumber 2>NUL');

        if (!$cpu || !$hdd) {
            return '';
        }

        $cpuLines = explode("\n", trim($cpu));
        $cpuId = $cpuLines[1] ?? '';
        $hddLines = explode("\n", trim($hdd));
        $hddId = $hddLines[1] ?? '';

        $cpuId = preg_replace('/\s+/', '', $cpuId);
        $hddId = preg_replace('/\s+/', '', $hddId);

        $raw = $cpuId . '|' . $hddId;

        if (strlen($raw) < 10) {
            return '';
        }

        return hash('sha256', $raw);
    }

    function getManualSysh(): string
    {
        if (empty(CPU) || empty(HDD)) {
            require_once(BASE_PATH . '/resources/views/app/errors/hardware-error.php');
            exit();
        }
        return hash('sha256', CPU . '|' . HDD);
    }

    function validateHardware(): void
    {
        $realHash = $this->getSysh();
        $manualHash = $this->getManualSysh();

        if ($realHash === '' || $manualHash === '' || !hash_equals($realHash, $manualHash)) {
            require_once(BASE_PATH . '/resources/views/app/errors/hardware-error.php');
            exit();
        }
    }

    // get and check date
    function validateLicenseDate(): void
    {
        $start = strtotime(start_date);
        $end = strtotime(end_date);
        $now = time();

        if ($now < $start) {
            require_once(BASE_PATH . '/resources/views/app/errors/date-error.php');
            exit();
        }

        if ($now > $end) {
            require_once(BASE_PATH . '/resources/views/app/errors/date-expired.php');
            exit();
        }
    }

    function checkLicensePeriodically(int $hardwareCheckHours = 12): void
    {
        $now = time();
        $interval = $hardwareCheckHours * 3600;

        $this->validateLicenseDate();

        if (
            !isset($_SESSION['last_hardware_check']) ||
            ($now - $_SESSION['last_hardware_check']) >= $interval
        ) {
            $this->validateHardware();
            $this->updateEncryptedDate();
            $_SESSION['last_hardware_check'] = $now;
        }
    }

    private $encryption_key = 's3cureP@ssw0rdKey';

    public function encrypt(string $data)
    {
        return openssl_encrypt($data, 'AES-128-ECB', $this->encryption_key);
    }

    public function decrypt(string $encryptedData)
    {
        return openssl_decrypt($encryptedData, 'AES-128-ECB', $this->encryption_key);
    }

    // check date
    public function getEncryptedDate(): ?string
    {
        $row = $this->select('SELECT shwo_section FROM settings LIMIT 1')->fetch();
        if (!$row) {
            return null;
        }
        return $row['shwo_section'];
    }
    public function updateEncryptedDate(): bool
    {
        $id = 1;

        $now = date('Y-m-d H:i:s');
        $encryptedNow = $this->encrypt($now);

        $currentEncryptedDate = $this->getEncryptedDate();

        if (!$currentEncryptedDate) {
            throw new \Exception("تاریخ قبلی یافت نشد.");
        }

        $currentDate = $this->decrypt($currentEncryptedDate);

        if (!$currentDate) {
            throw new \Exception("خطا در رمزگشایی تاریخ.");
        }

        if (strtotime($currentDate) > strtotime($now)) {
            throw new \Exception("خطا: تاریخ سیستم کاربر غیرمجاز است.");
        }

        return $this->update(
            'settings',
            $id,
            ['shwo_section'],
            [$encryptedNow]
        );
    }
}
