<?php
/**
 * This is the template for generating the model class of a specified table.
 *
 * @var yii\web\View $this
 * @var mootensai\enhancedgii\model\Generator $generator
 * @var string $tableName full table name
 * @var string $className class name
 * @var yii\db\TableSchema $tableSchema
 * @var string[] $labels list of attribute labels (name => label)
 * @var string[] $rules list of validation rules
 * @var array $relations list of relations (name => relation declaration)
 */

echo "<?php\n";
?>

namespace <?= $generator->nsModel ?>;

use Yii;
use \<?= $generator->nsModel ?>\base\<?= $className ?> as Base<?= $className ?>;

/**
 * This is the model class for table "<?= $tableName ?>".
 */
class <?= $className ?> extends Base<?= $className . "\n" ?>
{
    /**
     * @inheritdoc
     */
    const SCENARIO_VIEW = 'view';
    const SCENARIO_CREATE = 'create';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_COPY = 'copy';

    public scenarios ()
    {
        $scenarios = [
            self::SCENARIO_CREATE => [<?= implode(',', $scenarios) ?>],
            self::SCENARIO_UPDATE => [<?= implode(',', $scenarios) ?>],
            self::SCENARIO_COPY => [<?= implode(',', $scenarios) ?>],
        ];
        $scenarios += parent::scenarios();
        return $scenarios;
    }
	
<?php if ($generator->generateAttributeHints): ?>
    /**
     * @inheritdoc
     */
    public function attributeHints()
    {
        return [
<?php foreach ($labels as $name => $label): ?>
<?php if (!in_array($name, $generator->skippedColumns)): ?>
            <?= "'$name' => " . $generator->generateString($label) . ",\n" ?>
<?php endif; ?>
<?php endforeach; ?>
        ];
    }
<?php endif; ?>
}
