<?php

$table = $this->getConnection()->newTable($this->getTable('zenc_emaillogger/logitem'));

$table->addColumn(
    'mail_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'identity' => true
    ),
    'Mail ID'
);
$table->addColumn(
    'from_email',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => false),
    'From Email'
);
$table->addColumn(
    'from_name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => false),
    'From Name'
);
$table->addColumn(
    'to_email',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => false),
    'To Email'
);
$table->addColumn(
    'to_name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => false),
    'To Name'
);
$table->addColumn(
    'reply_to_email',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => true),
    'Reply To Email'
);
$table->addColumn(
    'reply_to_name',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => true),
    'Reply To Name'
);
$table->addColumn(
    'recipients',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array('nullable' => false),
    'Recipients Serialized'
);
$table->addColumn(
    'return_path',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => true),
    'Return Path'
);
$table->addColumn(
    'subject',
    Varien_Db_Ddl_Table::TYPE_VARCHAR,
    255,
    array('nullable' => true),
    'Subject'
);
$table->addColumn(
    'body_text',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array('nullable' => true),
    'Plain Body'
);
$table->addColumn(
    'body_html',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array('nullable' => true),
    'HTML Body'
);
$table->addColumn(
    'headers',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array('nullable' => false),
    'Headers Serialized'
);
$table->addColumn(
    'raw',
    Varien_Db_Ddl_Table::TYPE_TEXT,
    null,
    array('nullable' => false),
    'Raw Contents'
);
$table->addColumn(
    'customer_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array('nullable' => true),
    'Customer ID (if available)'
);
$table->addColumn(
    'quote_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array('nullable' => true),
    'Quote ID (if available)'
);
$table->addColumn(
    'order_id',
    Varien_Db_Ddl_Table::TYPE_INTEGER,
    null,
    array('nullable' => true),
    'Order ID (if available)'
);
$table->addColumn(
    'created_at',
    Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
    null,
    array('nullable' => false),
    'Timestamp'
);

$this->getConnection()->createTable($table);
