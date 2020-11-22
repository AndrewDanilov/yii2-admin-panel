<?php
namespace andrewdanilov\adminpanel\widgets;

use Yii;
use yii\helpers\Html;

class Menu extends \yii\base\Widget
{
	public $options = [];
	public $items = [];

	public function run()
	{
		$result = [];
		foreach ($this->items as $item) {
			if (!empty($item['options'])) {
				$itemOptions = $item['options'];
			} else {
				$itemOptions = [];
			}

			if (isset($item['url'])) {

				$icon = '';
				if (isset($item['icon'])) {
					if (is_array($item['icon'])) {
						if (isset($item['icon']['symbol'])) {
							$class = 'fa-' . $item['icon']['symbol'];
							if (!isset($item['icon']['type'])) {
								$item['icon']['type'] = '';
							}
							switch ($item['icon']['type']) {
								case 'regular': $class = 'far ' . $class; break;
								case 'light': $class = 'fal ' . $class; break;
								case 'solid': $class = 'fas ' . $class; break;
								default: $class = 'fa ' . $class; break;
							}
							$icon = Html::tag('i', null, ['class' => $class]);
						}
					} else {
						$icon = Html::tag('i', null, ['class' => 'fa fa-' . $item['icon']]);
					}
				}

				$label = '';
				if (isset($item['label'])) {
					if (!empty($item['labelOptions'])) {
						$labelOptions = $item['labelOptions'];
					} else {
						$labelOptions = [];
					}
					$label = Html::tag('span', $item['label'], $labelOptions);
				}

				if (!isset($itemOptions['class'])) {
					$itemOptions['class'] = '';
				}
				$itemOptions['class'] = self::addCssClass('list-group-item', $itemOptions['class']);
				if (self::isItemActive($item)) {
					$itemOptions['class'] = self::addCssClass('active', $itemOptions['class']);
				}
				$itemContent = Html::a($icon . $label, $item['url'], $itemOptions);

			} elseif (isset($item['label'])) {

				if (!isset($itemOptions['class'])) {
					$itemOptions['class'] = '';
				}
				$itemOptions['class'] = self::addCssClass('sidebar-header', $itemOptions['class']);
				$itemContent = Html::tag('div', $item['label'], $itemOptions);

			} else {

				if (!isset($itemOptions['class'])) {
					$itemOptions['class'] = '';
				}
				$itemOptions['class'] = self::addCssClass('sidebar-devider', $itemOptions['class']);
				$itemContent = Html::tag('hr', null, $itemOptions);

			}

			$result[] = $itemContent;

		}

		$options = $this->options;
		if (!isset($options['class'])) {
			$options['class'] = '';
		}
		$options['class'] = self::addCssClass('list-group', $options['class']);

		return Html::tag('div', implode("\n", $result), $options);
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
			$currentRoute = Yii::$app->controller->getRoute();
			$currentParams = Yii::$app->request->getQueryParams();

			$posDefaultAction = strpos($currentRoute, Yii::$app->controller->defaultAction);
			if ($posDefaultAction) {
				$noDefaultAction = rtrim(substr($currentRoute, 0, $posDefaultAction), '/');
			} else {
				$noDefaultAction = false;
			}
			$posDefaultRoute = strpos($currentRoute, Yii::$app->controller->module->defaultRoute);
			if ($posDefaultRoute) {
				$noDefaultRoute = rtrim(substr($currentRoute, 0, $posDefaultRoute), '/');
			} else {
				$noDefaultRoute = false;
			}

			$route = $item['url'][0];
			if (isset($route[0]) && $route[0] !== '/' && Yii::$app->controller) {
				$route = ltrim(Yii::$app->controller->module->getUniqueId() . '/' . $route, '/');
			}
			$route = ltrim($route, '/');
			if ($route != $currentRoute && $route !== $noDefaultRoute && $route !== $noDefaultAction) {
				return false;
			}
			unset($item['url']['#']);
			if (count($item['url']) > 1) {
				foreach (array_splice($item['url'], 1) as $name => $value) {
					if ($value !== null && (!isset($currentParams[$name]) || $currentParams[$name] != $value)) {
						return false;
					}
				}
			}
			return true;
		}
		return false;
	}
}