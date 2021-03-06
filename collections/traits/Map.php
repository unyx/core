<?php namespace nyx\core\collections\traits;

// Internal dependencies
use nyx\core\collections\interfaces;

/**
 * Map
 *
 * Allows for the implementation of the collections\interfaces\Map interface.
 *
 * @version     0.1.0
 * @author      Michal Chojnacki <m.chojnacki@muyo.io>
 * @copyright   2012-2017 Nyx Dev Team
 * @link        https://github.com/unyx/nyx
 */
trait Map
{
    /**
     * The traits of a Map trait.
     */
    use Collection;

    /**
     * @see \nyx\core\collections\interfaces\Map::get()
     */
    public function get($key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::set()
     */
    public function set($key, $value) : interfaces\Map
    {
        if (!isset($key, $value)) {
            throw new \InvalidArgumentException('Items in a Map must have a key and a value that are not null.');
        }

        $this->items[$key] = $value;

        return $this;
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::has()
     */
    public function has($key) : bool
    {
        return isset($this->items[$key]);
    }

    /**
     * @see \nyx\core\collections\interfaces\Collection::contains()
     */
    public function contains($item) : bool
    {
        return empty($this->items) ? false : (null !== $this->key($item));
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::remove()
     */
    public function remove($key) : interfaces\Map
    {
        unset($this->items[$key]);

        return $this;
    }

    /**
     * @see \nyx\core\collections\interfaces\Collection::replace()
     */
    public function replace($items) : interfaces\Collection
    {
        $this->items = [];

        foreach ($this->extractItems($items) as $key => $item) {
            $this->set($key, $item);
        }

        return $this;
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::key()
     */
    public function key($item)
    {
        foreach ($this->items as $key => $value) {
            if ($value === $item) {
                return $key;
            }
        }

        return null;
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::keys()
     */
    public function keys($of = null) : array
    {
        return array_keys($this->items, $of, true);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::values()
     */
    public function values() : array
    {
        return array_values($this->items);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::get()
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::set()
     */
    public function __set($key, $item)
    {
        $this->set($key, $item);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::has()
     */
    public function __isset($key) : bool
    {
        return $this->has($key);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::remove()
     */
    public function __unset($key)
    {
        return $this->remove($key);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::get()
     */
    public function offsetGet($key)
    {
        return $this->get($key);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::set()
     */
    public function offsetSet($key, $item)
    {
        return $this->set($key, $item);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::has()
     */
    public function offsetExists($key)
    {
        return $this->has($key);
    }

    /**
     * @see \nyx\core\collections\interfaces\Map::remove()
     */
    public function offsetUnset($key)
    {
        return $this->remove($key);
    }
}
