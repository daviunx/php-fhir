<?php

namespace DCarbone\PHPFHIR\Definition;

/*
 * Copyright 2016-2019 Daniel Carbone (daniel.p.carbone@gmail.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Trait DocumentationTrait
 * @package DCarbone\PHPFHIR
 */
trait DocumentationTrait
{
    /** @var null|array */
    private $documentation = null;

    /**
     * @return array
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * @return string
     */
    public function getDocumentationString()
    {
        return implode("\n", $this->getDocumentation());
    }

    /**
     * @param string $documentation
     * @return static
     */
    public function setDocumentation($documentation)
    {
        if (null !== $documentation) {
            if (is_string($documentation)) {
                $documentation = [$documentation];
            }

            if (is_array($documentation)) {
                $this->documentation = $documentation;
            } else {
                throw new \InvalidArgumentException('Documentation expected to be array, string, or null.');
            }
        }
        return $this;
    }

    /**
     * @param int $spaces
     * @param bool $trailingNewline
     * @return string
     */
    public function getDocBlockDocumentationFragment($spaces = 5, $trailingNewline = true)
    {
        $output = '';
        $spaces = str_repeat(' ', $spaces);
        if (isset($this->documentation)) {
            foreach ($this->documentation as $i => $doc) {
                if ($i > 0) {
                    $output .= "\n";
                }
                $output = sprintf("%s%s* %s", $output, $spaces, $doc);
            }
        }
        return $trailingNewline ? "{$output}\n" : $output;
    }
}