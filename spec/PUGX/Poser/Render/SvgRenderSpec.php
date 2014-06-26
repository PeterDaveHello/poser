<?php

namespace spec\PUGX\Poser\Render;

use PhpSpec\Exception\Exception;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use PUGX\Poser\Badge;
use PUGX\Poser\Calculator\TextSizeCalculatorInterface;

class SvgRenderSpec extends ObjectBehavior
{
    function let(TextSizeCalculatorInterface $calculator)
    {
        $calculator->calculateWidth(Argument::any())->willReturn(20);
        $this->beConstructedWith($calculator);
    }

    function it_should_render_a_svg()
    {
        $badge = Badge::fromURI('version-stable-97CA00.svg');
        $this->render($badge)->shouldBeAValidSVGImage();
    }

    public function getMatchers()
    {
        return [
            'beAValidSVGImage' => function($subject) {

                    $regex = '/^<svg.*width="((.|\n)*)<\/svg>$/';
                    $matches = array();

                    return preg_match($regex, $subject, $matches, PREG_OFFSET_CAPTURE, 0);
                },
            'beAValidSVGImageContaining' => function($object, $subject, $status) {

                    $regex = '/^<svg.*width="((.|\n)*)'.$subject.'((.|\n)*)'.$status.'((.|\n)*)<\/svg>$/';
                    $matches = array();

                    return preg_match($regex, $object, $matches, PREG_OFFSET_CAPTURE, 0);
                },
        ];
    }
} 