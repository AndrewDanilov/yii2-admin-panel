<?php

namespace andrewdanilov\adminpanel;

use Yii;
use yii\helpers\Html;

class Menu extends \yii\base\Widget
{
	public $options = [];
	public $items = [];

	public $route;
	public $params;

	private $noDefaultRoute;
	private $noDefaultAction;

	public function run()
	{
		if ($this->route === null && Yii::$app->controller !== null) {
			$this->route = Yii::$app->controller->getRoute();
		}
		if ($this->params === null) {
			$this->params = Yii::$app->request->getQueryParams();
		}
		$posDefaultAction = strpos($this->route, Yii::$app->controller->defaultAction);
		if ($posDefaultAction) {
			$this->noDefaultAction = rtrim(substr($this->route, 0, $posDefaultAction), '/');
		} else {
			$this->noDefaultAction = false;
		}
		$posDefaultRoute = strpos($this->route, Yii::$app->controller->module->defaultRoute);
		if ($posDefaultRoute) {
			$this->noDefaultRoute = rtrim(substr($this->route, 0, $posDefaultRoute), '/');
		} else {
			$this->noDefaultRoute = false;
		}

		$result = [];
		foreach ($this->items as $item) {
			$itemOptions = $item['options'] ?: [];

			if (isset($item['url'])) {

				$icon = '';
				if (isset($item['icon'])) {
					$icon = Html::tag('i', null, ['class' => 'fa fa-' . $item['icon']]);
				}

				$label = '';
				if (isset($item['label'])) {
					$labelOptions = $item['labelOptions'] ?: [];
					$label = Html::tag('span', $item['label'], $labelOptions);
				}

				$itemOptions['class'] = self::addCssClass('list-group-item', $itemOptions['class']);
				if (self::isItemActive($item)) {
					$itemOptions['class'] = self::addCssClass('active', $itemOptions['class']);
				}
				$itemContent = Html::a($icon . $label, $item['url'], $itemOptions);

			} elseif (isset($item['label'])) {

				$labelOptions = $item['labelOptions'] ?: [];
				$label = Html::tag('span', $item['label'], $labelOptions);

				$itemOptions['class'] = self::addCssClass('sidebar-header', $itemOptions['class']);
				$itemContent = $label;

			} else {

				$itemOptions['class'] = self::addCssClass('sidebar-devider', $itemOptions['class']);
				$itemContent = Html::tag('hr', null, $itemOptions);

			}

			$result[] = $itemContent;

		}

		$options = $this->options;
		$options['class'] = self::addCssClass('list-group', $options['class']);
		$html = Html::tag('div', implode("\n", $result), $options);
		return $html;
	}

	/**
	 * Add css-class name to original css-classes string
	 *
	 * @param string $class - added css-class
	 * @param string $origClasses - original css-classes
	 * @return string
	 */
	private static function addCssClass($class, $origClasses) {
		if ($origClasses) {
			$classes = explode(' ', $origClasses);
		} else {
			$classes = [];
		}
		if (!in_array($class, $classes)) {
			$classes[] = $class;
		}
		return implode(' ', $classes);
	}

	/**
	 * Checks whether a menu item is active.
	 * This is done by checking if [[route]] and [[params]] match that specified in the `url` option of the menu item.
	 * When the `url` option of a menu item is specified in terms of an array, its first element is treated
	 * as the route for the item and the rest of the elements are the associated parameters.
	 * Only when its route and parameters match [[route]] and [[params]], respectively, will a menu item
	 * be considered active.
	 * @param array $item the menu item to be checked
	 * @return boolean whether the menu item is active
	 */
	protected function isItemActive($item)
	{
		if (isset($item['url']) && is_array($item['url']) && isset($item['url'][0])) {
			$route = $item['url'][0];
			if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
				$route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
			}
			$route = ltrim($route, '/');
			if ($route != $this->route && $route !== $this->noDefaultRoute && $route !== $this->noDefaultAction) {
				return false;
			}
			unset($item['url']['#']);
			if (count($item['url']) > 1) {
				foreach (array_splice($item['url'], 1) as $name => $value) {
					if ($value !== null && (!isset($this->params[$name]) || $this->params[$name] != $value)) {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}
}