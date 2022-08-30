<?php
/**
 * @link http://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license http://craftcms.com/license
 */

namespace craft\behaviors;

use yii\base\Behavior;

/**
 * Custom field behavior
 *
 * This class provides attributes for all the unique custom field handles.
 *
 * @method static nuts(mixed $value) Sets the [[nuts]] property
 * @method static flavor(mixed $value) Sets the [[flavor]] property
 * @method static notes(mixed $value) Sets the [[notes]] property
 * @method static selected(mixed $value) Sets the [[selected]] property
 * @method static accentColor(mixed $value) Sets the [[accentColor]] property
 * @method static primaryColor(mixed $value) Sets the [[primaryColor]] property
 * @method static header(mixed $value) Sets the [[header]] property
 * @method static list(mixed $value) Sets the [[list]] property
 * @method static localNavigation(mixed $value) Sets the [[localNavigation]] property
 * @method static text(mixed $value) Sets the [[text]] property
 * @method static linkTitle(mixed $value) Sets the [[linkTitle]] property
 * @method static item(mixed $value) Sets the [[item]] property
 * @method static pagetitle(mixed $value) Sets the [[pagetitle]] property
 * @method static sectionGroup(mixed $value) Sets the [[sectionGroup]] property
 * @method static linkUrl(mixed $value) Sets the [[linkUrl]] property
 * @method static class(mixed $value) Sets the [[class]] property
 * @method static background(mixed $value) Sets the [[background]] property
 * @method static sectionTitle(mixed $value) Sets the [[sectionTitle]] property
 * @method static image(mixed $value) Sets the [[image]] property
 * @method static linkToButton(mixed $value) Sets the [[linkToButton]] property
 * @method static infoPanel(mixed $value) Sets the [[infoPanel]] property
 * @method static buttonText(mixed $value) Sets the [[buttonText]] property
 * @method static buttonSlug(mixed $value) Sets the [[buttonSlug]] property
 * @method static richText(mixed $value) Sets the [[richText]] property
 * @method static imageCaption(mixed $value) Sets the [[imageCaption]] property
 * @method static linkTo(mixed $value) Sets the [[linkTo]] property
 */
class CustomFieldBehavior extends Behavior
{
    /**
     * @var bool Whether the behavior should provide methods based on the field handles.
     */
    public bool $hasMethods = false;

    /**
     * @var bool Whether properties on the class should be settable directly.
     */
    public bool $canSetProperties = true;

    /**
     * @var string[] List of supported field handles.
     */
    public static $fieldHandles = [
        'nuts' => true,
        'flavor' => true,
        'notes' => true,
        'selected' => true,
        'accentColor' => true,
        'primaryColor' => true,
        'header' => true,
        'list' => true,
        'localNavigation' => true,
        'text' => true,
        'linkTitle' => true,
        'item' => true,
        'pagetitle' => true,
        'sectionGroup' => true,
        'linkUrl' => true,
        'class' => true,
        'background' => true,
        'sectionTitle' => true,
        'image' => true,
        'linkToButton' => true,
        'infoPanel' => true,
        'buttonText' => true,
        'buttonSlug' => true,
        'richText' => true,
        'imageCaption' => true,
        'linkTo' => true,
    ];

    /**
     * @var bool Value for field with the handle “nuts”.
     */
    public $nuts;

    /**
     * @var \craft\elements\db\EntryQuery Value for field with the handle “flavor”.
     */
    public $flavor;

    /**
     * @var string|null Value for field with the handle “notes”.
     */
    public $notes;

    /**
     * @var bool Value for field with the handle “selected”.
     */
    public $selected;

    /**
     * @var \craft\fields\data\ColorData|null Value for field with the handle “accentColor”.
     */
    public $accentColor;

    /**
     * @var \craft\fields\data\ColorData|null Value for field with the handle “primaryColor”.
     */
    public $primaryColor;

    /**
     * @var string|null Value for field with the handle “header”.
     */
    public $header;

    /**
     * @var \craft\elements\db\MatrixBlockQuery Value for field with the handle “list”.
     */
    public $list;

    /**
     * @var \craft\elements\db\MatrixBlockQuery Value for field with the handle “localNavigation”.
     */
    public $localNavigation;

    /**
     * @var string|null|mixed Value for field with the handle “text”.
     */
    public $text;

    /**
     * @var string|null Value for field with the handle “linkTitle”.
     */
    public $linkTitle;

    /**
     * @var string|null Value for field with the handle “item”.
     */
    public $item;

    /**
     * @var string|null Value for field with the handle “pagetitle”.
     */
    public $pagetitle;

    /**
     * @var \craft\elements\db\MatrixBlockQuery Value for field with the handle “sectionGroup”.
     */
    public $sectionGroup;

    /**
     * @var string|null Value for field with the handle “linkUrl”.
     */
    public $linkUrl;

    /**
     * @var string|null Value for field with the handle “class”.
     */
    public $class;

    /**
     * @var \craft\fields\data\SingleOptionFieldData Value for field with the handle “background”.
     */
    public $background;

    /**
     * @var string|null Value for field with the handle “sectionTitle”.
     */
    public $sectionTitle;

    /**
     * @var \craft\elements\db\AssetQuery Value for field with the handle “image”.
     */
    public $image;

    /**
     * @var string|null Value for field with the handle “linkToButton”.
     */
    public $linkToButton;

    /**
     * @var \craft\elements\db\MatrixBlockQuery Value for field with the handle “infoPanel”.
     */
    public $infoPanel;

    /**
     * @var string|null Value for field with the handle “buttonText”.
     */
    public $buttonText;

    /**
     * @var string|null Value for field with the handle “buttonSlug”.
     */
    public $buttonSlug;

    /**
     * @var mixed Value for field with the handle “richText”.
     */
    public $richText;

    /**
     * @var string|null Value for field with the handle “imageCaption”.
     */
    public $imageCaption;

    /**
     * @var string|null Value for field with the handle “linkTo”.
     */
    public $linkTo;

    /**
     * @var array Additional custom field values we don’t know about yet.
     */
    private array $_customFieldValues = [];

    /**
     * @inheritdoc
     */
    public function __call($name, $params)
    {
        if ($this->hasMethods && isset(self::$fieldHandles[$name]) && count($params) === 1) {
            $this->$name = $params[0];
            return $this->owner;
        }
        return parent::__call($name, $params);
    }

    /**
     * @inheritdoc
     */
    public function hasMethod($name): bool
    {
        if ($this->hasMethods && isset(self::$fieldHandles[$name])) {
            return true;
        }
        return parent::hasMethod($name);
    }

    /**
     * @inheritdoc
     */
    public function __isset($name): bool
    {
        if (isset(self::$fieldHandles[$name])) {
            return true;
        }
        return parent::__isset($name);
    }

    /**
     * @inheritdoc
     */
    public function __get($name)
    {
        if (isset(self::$fieldHandles[$name])) {
            return $this->_customFieldValues[$name] ?? null;
        }
        return parent::__get($name);
    }

    /**
     * @inheritdoc
     */
    public function __set($name, $value)
    {
        if (isset(self::$fieldHandles[$name])) {
            $this->_customFieldValues[$name] = $value;
            return;
        }
        parent::__set($name, $value);
    }

    /**
     * @inheritdoc
     */
    public function canGetProperty($name, $checkVars = true): bool
    {
        if ($checkVars && isset(self::$fieldHandles[$name])) {
            return true;
        }
        return parent::canGetProperty($name, $checkVars);
    }

    /**
     * @inheritdoc
     */
    public function canSetProperty($name, $checkVars = true): bool
    {
        if (!$this->canSetProperties) {
            return false;
        }
        if ($checkVars && isset(self::$fieldHandles[$name])) {
            return true;
        }
        return parent::canSetProperty($name, $checkVars);
    }
}
