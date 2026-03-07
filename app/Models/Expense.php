<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['description', 'amount', 'staff'];
    protected $table = 'expenses';
    
    private static $storageFile = null;
    
    /**
     * Get the storage file path
     */
    private static function getStorageFile(): string
    {
        if (self::$storageFile === null) {
            self::$storageFile = storage_path('expenses.json');
        }
        return self::$storageFile;
    }
    
    /**
     * Read all expenses from storage
     */
    public static function readFromStorage(): array
    {
        $file = self::getStorageFile();
        if (!file_exists($file)) {
            return [];
        }
        $content = file_get_contents($file);
        return json_decode($content, true) ?? [];
    }
    
    /**
     * Write expenses to storage
     */
    public static function writeToStorage(array $expenses): void
    {
        $file = self::getStorageFile();
        $dir = dirname($file);
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        file_put_contents($file, json_encode($expenses, JSON_PRETTY_PRINT));
    }
    
    /**
     * Get all expenses ordered by date
     */
    public static function getAll(): array
    {
        $expenses = self::readFromStorage();
        usort($expenses, function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        return $expenses;
    }
    
    /**
     * Get total expenses sum
     */
    public static function getTotal(): float
    {
        $expenses = self::readFromStorage();
        return array_sum(array_column($expenses, 'amount'));
    }
    
    /**
     * Create a new expense
     */
    public static function createExpense(array $data): self
    {
        $expenses = self::readFromStorage();
        $id = count($expenses) > 0 ? max(array_column($expenses, 'id')) + 1 : 1;
        
        $expense = new self();
        $expense->id = $id;
        $expense->description = $data['description'];
        $expense->amount = (float) $data['amount'];
        $expense->staff = $data['staff'];
        $expense->created_at = now()->toDateTimeString();
        $expense->updated_at = now()->toDateTimeString();
        
        $expenses[] = [
            'id' => $expense->id,
            'description' => $expense->description,
            'amount' => $expense->amount,
            'staff' => $expense->staff,
            'created_at' => $expense->created_at,
            'updated_at' => $expense->updated_at,
        ];
        
        self::writeToStorage($expenses);
        
        return $expense;
    }
    
    /**
     * Delete an expense
     */
    public static function deleteExpense(int $id): bool
    {
        $expenses = self::readFromStorage();
        $initialCount = count($expenses);
        
        $expenses = array_filter($expenses, function($expense) use ($id) {
            return $expense['id'] !== $id;
        });
        
        if (count($expenses) < $initialCount) {
            self::writeToStorage(array_values($expenses));
            return true;
        }
        
        return false;
    }
    
    /**
     * Update an expense
     */
    public static function updateExpense(int $id, array $data): bool
    {
        $expenses = self::readFromStorage();
        $found = false;
        
        foreach ($expenses as &$expense) {
            if ($expense['id'] === $id) {
                $expense['description'] = $data['description'];
                $expense['amount'] = (float) $data['amount'];
                $expense['staff'] = $data['staff'];
                $expense['updated_at'] = now()->toDateTimeString();
                $found = true;
                break;
            }
        }
        
        if ($found) {
            self::writeToStorage($expenses);
            return true;
        }
        
        return false;
    }
    
    /**
     * Get a single expense by ID
     */
    public static function getById(int $id): ?array
    {
        $expenses = self::readFromStorage();
        
        foreach ($expenses as $expense) {
            if ($expense['id'] === $id) {
                return $expense;
            }
        }
        
        return null;
    }
}

