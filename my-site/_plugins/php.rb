module Jekyll
    class PHPTag < Liquid::Tag
      def initialize(tag_name, text, tokens)
        super
        @text = text
      end
  
      def render(context)
        output = `php -r "echo #{@text};" 2>&1`
        if $?.success?
          output
        else
          raise "PHP Error: #{output}"
        end
      end
    end
  end
  
  Liquid::Template.register_tag('php', Jekyll::PHPTag)
  