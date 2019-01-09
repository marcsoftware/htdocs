<!DOCTYPE html>
<html dir="ltr">

<head>
    <script type="text/javascript">
    function scrollToElement(){
        var elementID = `<?php echo $_GET['s'] ?>`;
        document.getElementById(elementID).scrollIntoView();
        
        
    }

    window.onload=scrollToElement;
    </script>
    <meta charset="UTF-8">
    <title>Downloaded Grammar 1</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body class="container">
<div class="row d-block">
    <h1 class="p-2 mt-5 mb-2 bg-success text-white">Duolingo German Tips and Notes</h1>
</div>


<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">1 Welcome to German :)</h3>
    <div>
        <p>
            Welcome to the German course! We will provide you with tips and notes throughout the course. However, be
            aware that these are optional. Only read them when you feel stuck, or when you are interested in the
            details. You can use the course without them.
        </p>
        <p>
            Often, it's best to just <strong>dive into the practice</strong>. See how it goes! You can always revisit the
            Notes section later on.
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">2 Capitalizing nouns</h3>
    <div>
        <p>
            In German, <strong>all nouns are capitalized</strong>. For example, "my name" is <em>mein <strong>N</strong>ame</em>,
            and "the apple" is <em>der <strong>A</strong>pfel</em>. This helps you identify which words are the nouns in
            a sentence.
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">3 German genders are strange</h3>
    <div>
        <p>
            Nouns in German are either <strong>feminine, masculine or neuter</strong>. For example, <em>Frau</em> (woman)
            is feminine, <em>Mann</em> (man) is masculine, and <em>Kind</em> (child) is neuter.
        </p>
        <p>
            While some nouns (Frau, Mann, …) have <strong>natural gender</strong> like in English (a woman is female, a
            man is male), <strong>most nouns have grammatical gender</strong> (depends on word ending, or seemingly
            random).
        </p>
        <p>
            For example, <em>Mädchen</em> (girl) is neuter, because all words ending in <em>-chen</em> are neuter. <em>Wasser</em>
            (water) is neuter, but <em>Cola</em> is feminine, and <em>Saft</em> (juice) is masculine.
        </p>
        <p>
            It is important to <strong>learn every noun along with its gender</strong> because parts of German sentences
            change depending on the gender of their nouns.
        </p>
        <p>
            For now, just remember that the <strong>indefinite article</strong> (a/an) <em>ein</em> is used for masculine
            and neuter nouns, and <em>eine</em> is used for feminine nouns. Stay with us to find out how "cases" will
            later modify these.
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>gender</th>
                <th>indefinite article</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>masculine</td>
                <td><strong>ein</strong> Mann</td>
            </tr>
            <tr>
                <td>neuter</td>
                <td><strong>ein</strong> Mädchen</td>
            </tr>
            <tr>
                <td>feminine</td>
                <td><strong>eine</strong> Frau</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">4 Verb conjugations</h3>
    <div>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">5 Conjugating regular verbs</h4>
    <div>
        <p>
            <strong>Verb conjugation</strong> in German is more complex than in English. To conjugate a regular verb in
            the present tense, identify the stem of the verb and <strong>add the ending</strong> corresponding to any of
            the grammatical persons, which you can simply memorize. For now, here are the singular forms:
        </p>
        <p>Example: <em>trinken</em> (to drink)</p>
        <table class="table">
            <thead>
            <tr>
                <th>English person</th>
                <th>ending</th>
                <th>German example</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>-e</td>
                <td>ich trink<strong>e</strong></td>
            </tr>
            <tr>
                <td>you (singular informal)</td>
                <td>-st</td>
                <td>du trink<strong>st</strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>-t</td>
                <td>er/sie/es trink<strong>t</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">6 Conjugations of the verb <em>sein</em> (to be)</h4>
    <div>
        <p>
            Like in English, <em>sein</em> (to be) is completely irregular, and its conjugations simply need to be
            memorized. Again, you will learn the plural forms soon.
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I am</td>
                <td>ich <strong>bin</strong></td>
            </tr>
            <tr>
                <td>you (singular informal) are</td>
                <td>du <strong>bist</strong></td>
            </tr>
            <tr>
                <td>he/she/it is</td>
                <td>er/sie/es <strong>ist</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">7 Umlauts</h3>
    <div>
        <p>
            <strong>Umlauts</strong> are letters (more specifically vowels) that have two dots above them and appear in
            some German words like <em>Mädchen</em>.
        </p>
        <p>
            <em>
                Literally, "Umlaut" means "around the sound," because its function is to change how the vowel
                sounds.
            </em>
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>no umlaut</th>
                <th>umlaut</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>a</td>
                <td>ä</td>
            </tr>
            <tr>
                <td>o</td>
                <td>ö</td>
            </tr>
            <tr>
                <td>u</td>
                <td>ü</td>
            </tr>
            </tbody>
        </table>
        <p>An umlaut change may change the meaning. That's why it's important not to ignore those little dots.</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">8 No continuous aspect</h3>
    <div>
        <p>
            In German, there's <strong>no continuous aspect</strong>. There are no separate forms for "I drink" and "I am
            drinking". There's only one form: <em>Ich trinke.</em>
        </p>
        <p>There's no such thing as <em>Ich bin trinke</em> or <em>Ich bin trinken!</em></p>
        <p>
            <em>
                When translating into English, how can I tell whether to use the simple (I drink) or the continuous form
                (I am drinking)?
            </em>
        </p>
        <p>Unless the context suggests otherwise, either form should be accepted.</p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">9 Definite articles</h3>
    <div>
        <p>
            As mentioned in <em>Basics 1</em>, German nouns have one of <strong>three genders</strong>: <strong>
            feminine,
            masculine or neuter
        </strong>.
        </p>
        <p>
            While they sometimes correspond to a <em>natural gender</em> ("der Mann" is male), most often the gender will
            depend on the word, not on the object it describes. For example, the word "das Mädchen" (the girl) ends in
            "-chen", hence it is neuter. This is called <em>grammatical gender</em>.
        </p>
        <p>
            Each gender has its own definite article. <strong><em>Der</em></strong> is used for masculine nouns, <strong><em>das</em></strong>
            for neuter, and <strong><em>die</em></strong> for feminine. Later in this course you will learn that these
            might be modified according to "case".
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>gender</th>
                <th>definite (the)</th>
                <th>indefinite (a/an)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>masculine</td>
                <td><strong>der</strong> Mann</td>
                <td><strong>ein</strong> Mann</td>
            </tr>
            <tr>
                <td>neuter</td>
                <td><strong>das</strong> Mädchen</td>
                <td><strong>ein</strong> Mädchen</td>
            </tr>
            <tr>
                <td>feminine</td>
                <td><strong>die</strong> Frau</td>
                <td><strong>eine</strong> Frau</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">10 Conjugating verbs</h3>
    <div>
        <p>Here are the conjugation tables from "Basics 1" (where you can find a more detailed explanation) again.</p>
        <p><em>trinken</em> (to drink)</p>
        <table class="table">
            <thead>
            <tr>
                <th>English person</th>
                <th>ending</th>
                <th>German example</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>-e</td>
                <td>ich trink<strong><em>e</em></strong></td>
            </tr>
            <tr>
                <td>you (singular informal)</td>
                <td>-st</td>
                <td>du trink<strong><em>st</em></strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>-t</td>
                <td>er/sie/es trink<strong><em>t</em></strong></td>
            </tr>
            </tbody>
        </table>
        <p><em>sein</em> (to be)</p>
        <table class="table">
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I am</td>
                <td>ich <strong>bin</strong></td>
            </tr>
            <tr>
                <td>you (singular informal) are</td>
                <td>du <strong>bist</strong></td>
            </tr>
            <tr>
                <td>he/she/it is</td>
                <td>er/sie/es <strong>ist</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">11 Generic vs. specific (German is not Spanish or French)</h3>
    <div>
        <p>
            Just like in English, using or dropping the definite article makes the <em>
            difference between specific and
            generic
        </em>.
        </p>
        <p>I like <em>bread</em> = Ich mag <em>Brot</em> (bread in general)</p>
        <p>I like <em>the bread</em> = Ich mag <em>das Brot</em> (specific bread)</p>
        <p>
            A good general rule is to use an article when you would use on in English. If there is none in English, don't
            use one in German.
        </p>
        <p>There are some slight differences when using a few abstract nouns, but we'll see about that later.</p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">12 German plurals are also strange :)</h3>
    <div>
        <p>
            In English, making plurals out of singular nouns is typically as straightforward as adding <em>-(e)s</em> at
            the end of the word. In German, the transformation is more complex. You will learn details about this in a
            later lesson.
        </p>
        <p>
            In some languages (such as French or Spanish), genders are also differentiated in the plural. In German, the
            <strong>plural form does not depend on what gender</strong> the singular form is.
        </p>
        <p>
            Regardless of grammatical gender, <strong>all plural nouns take the definite article <em>die</em></strong>.
            (You will later learn how "cases" can modify this.) This <em>does not make them feminine</em>. The
            grammatical gender of a word never changes. Like many other words, <em>die</em> is simply used for multiple
            purposes.
        </p>
        <p>Just like in English, there's <strong>no plural indefinite</strong> article.</p>
        <table class="table">
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>a man</td>
                <td>ein Mann</td>
            </tr>
            <tr>
                <td>men</td>
                <td>Männer</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">13 You, you and you</h3>
    <div>
        <p>Most languages use different words to address one person, or several people.</p>
        <p>In German, when <strong>addressing a single person, use <em>du</em></strong>:</p>
        <ul>
            <li><em>Du</em> bist mein Kind. (<em>You</em> are my child.)</li>
        </ul>
        <p>If you are talking to <strong>more than one person, use <em>ihr</em></strong>:</p>
        <ul>
            <li><em>Ihr</em> seid meine Kinder. (<em>You</em> are my children.)</li>
        </ul>
        <p>Some English speakers would use "y'all" or "you guys" for this plural form of "you".</p>
        <p>
            Note that these only work for people you are familiar with (friends, family, …). For others, you would use
            the formal "you", which we teach later in this course. So stay tuned :)
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">14 <em>Ihr</em> vs. <em>er</em></h3>
    <div>
        <p>
            If you're new to German, <em>ihr</em> and <em>er</em> may sound confusingly similar, but there is actually a
            difference. <em>ihr</em> sounds similar to the English word "ear", and <em>er</em> sounds similar to the
            English word "air" (imagine a British/RP accent).
        </p>
        <p>
            Don't worry if you can't pick up on the difference at first. You may need some more listening practice before
            you can tell them apart. Also, try using headphones instead of speakers.
        </p>
        <p>
            <strong>Learn the pronouns together with the verb endings</strong>. This will greatly reduce the amount of
            ambiguity.
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">15 Verb conjugation</h3>
    <div>
        <p>Here is the complete table for conjugating regular verbs:</p>
        <p>Example: <em>trinken</em> (to drink)</p>
        <table class="table">
            <thead>
            <tr>
                <th>English person</th>
                <th>ending</th>
                <th>German example</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>-e</td>
                <td><strong>ich</strong> trink<strong>e</strong></td>
            </tr>
            <tr>
                <td>you (singular informal)</td>
                <td>-st</td>
                <td><strong>du</strong> trink<strong>st</strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>-t</td>
                <td><strong>er/sie/es</strong> trink<strong>t</strong></td>
            </tr>
            <tr>
                <td>we</td>
                <td>-en</td>
                <td><strong>wir</strong> trink<strong>en</strong></td>
            </tr>
            <tr>
                <td>you (plural informal)</td>
                <td>-t</td>
                <td><strong>ihr</strong> trink<strong>t</strong></td>
            </tr>
            <tr>
                <td>they</td>
                <td>-en</td>
                <td><strong>sie</strong> trink<strong>en</strong></td>
            </tr>
            </tbody>
        </table>
        <p>Notice that the first and the third person plural have the same ending.</p>
        <p>And here's the complete table for the irregular verb <em>sein</em> (to be):</p>
        <table class="table">
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I am</td>
                <td><strong>ich bin</strong></td>
            </tr>
            <tr>
                <td>you (singular informal) are</td>
                <td><strong>du bist</strong></td>
            </tr>
            <tr>
                <td>he/she/it is</td>
                <td><strong>er/sie/es ist</strong></td>
            </tr>
            <tr>
                <td>we are</td>
                <td><strong>wir sind</strong></td>
            </tr>
            <tr>
                <td>you (plural informal) are</td>
                <td><strong>ihr seid</strong></td>
            </tr>
            <tr>
                <td>they are</td>
                <td><strong>sie sind</strong></td>
            </tr>
            </tbody>
        </table>
        <p>You will learn about the distinction between "formal" and "informal" later (it's easy).</p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">16 Common phrases</h3>
    <div>
        <p>
            Commonly used phrases are often <em>shortened versions of a longer sentence</em>. Or they might be <em>
            leftovers
            from some old grammar
        </em> that has otherwise fallen out of use. That means that their grammar might appear
            strange.
        </p>
        <p>For now, just learn them like you would learn a long word.</p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">17 <em>Wie geht's?</em></h4>
    <div>
        <p>
            There are many ways to ask someone how they are doing. Take "How are you?," "How do you do?" and "How is it
            going?" as examples. In German, the common phrase or idiom uses the verb <em>gehen</em> (go): <em>
            Wie geht
            es dir?
        </em> (How are you?).
        </p>
        <p>This can be shortened to <em>Wie geht's?</em>.</p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">18 <em>Willkommen</em> can be a false friend</h4>
    <div>
        <p>
            In German, <em>Willkommen</em> means welcome as in "Welcome to our home", but it does not mean welcome as in
            "Thank you - You're welcome". The German for the latter is <em>Gern geschehen</em> (or just <em>Gern!</em>)
            or <em>Keine Ursache</em>.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">19 <em>Entschuldigung!</em></h4>
    <div>
        <p>
            Sometimes, German words can be a mouthful. Later on, you will find that you can take long words apart, and
            recognize the meaning from its elements.
        </p>
        <p>Here's an example:</p>
        <table class="table">
            <thead>
            <tr>
                <th>Part</th>
                <th>Meaning</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ent-</td>
                <td>de-</td>
            </tr>
            <tr>
                <td>Schuld</td>
                <td>guilt</td>
            </tr>
            <tr>
                <td>-ig</td>
                <td>-y</td>
            </tr>
            <tr>
                <td>-gung</td>
                <td>noun suffix</td>
            </tr>
            </tbody>
        </table>
        <p>
            So, <em>Entschuldigung</em> literally means something like "deguiltification": "Take the guilt away from me"
            :)
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">20 Duo</h3>
    <div>
        <p>
            <em>Duo</em> is the name of Duolingo's mascot (the green owl). He will guide you through this course. If you
            make him happy, he will make you happy :)
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">21 German Cases</h3>
    <div>
        <p>
            In English, the words "he" and "I" can be used as subjects (the ones doing the action in a sentence), and
            they change to "him" and "me" when they are objects (the ones the action is applied to). Here's an
            example:
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>Subject</th>
                <th>Verb</th>
                <th>Object</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>see</td>
                <td>him</td>
            </tr>
            <tr>
                <td>He</td>
                <td>sees</td>
                <td>me</td>
            </tr>
            </tbody>
        </table>
        <p>
            This is called a <strong>grammatical case</strong>: the same word changes its form, depending on its
            relationship to the verb. In English, only pronouns have cases. In German, <strong>most words</strong> other
            than verbs (such as nouns, pronouns, determiners, adjectives, etc.) <strong>have cases</strong>.
        </p>
        <p>
            You'll learn more about cases later; for now you just need to understand the difference between the two
            simplest cases: <strong>nominative and accusative</strong>.
        </p>
        <p>
            The <strong>subject</strong> of a sentence (the one doing the action) is in the <strong>nominative</strong>
            case. So when we say <em>Die Frau spielt.</em> (The woman plays.), "die Frau" is in the nominative.
        </p>
        <p>
            The <em>accusative object</em> is the thing or person that is directly receiving the action. For example, in
            <em>Der Mann sieht den Ball.</em> (The man sees the ball.), <em>der Mann</em> is the (nominative) subject
            and <em>den Ball</em> is the (accusative) object.
        </p>
        <p>For the articles, nominative and accusative are nearly the same. Only the masculine ("der") forms change:</p>
        <table class="table">
            <thead>
            <tr>
                <th>"a(n)"</th>
                <th>masc.</th>
                <th>neut.</th>
                <th>fem.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Nominative</strong></td>
                <td>ein</td>
                <td>ein</td>
                <td>eine</td>
            </tr>
            <tr>
                <td><strong>Accusative</strong></td>
                <td><strong>einen</strong></td>
                <td>ein</td>
                <td>eine</td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th>"the"</th>
                <th>m.</th>
                <th>n.</th>
                <th>f.</th>
                <th>pl.</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Nom.</strong></td>
                <td>der</td>
                <td>das</td>
                <td>die</td>
                <td>die</td>
            </tr>
            <tr>
                <td><strong>Acc.</strong></td>
                <td><strong>den</strong></td>
                <td>das</td>
                <td>die</td>
                <td>die</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">22 Flexible sentence order</h3>
    <div>
        <p>
            The fact that most words in German are affected by the case explains why the <strong>
            sentence order is more
            flexible than in English
        </strong>. For example, you can say <em>Das Mädchen hat den Apfel.</em> (The girl
            has the apple.) or <em>Den Apfel hat das Mädchen.</em>. In both cases, <em>den Apfel</em> (the apple) is the
            accusative object, and <em>das Mädchen</em> is the subject (always nominative).
        </p>
        <p>
            However, take note that in German, the <strong>verb always has to be in position 2</strong>. If something
            other than the subject takes up position 1, the <strong>subject will then move after the verb</strong>.
        </p>
        <ul>
            <li>Normally, <strong>I drink</strong> water.</li>
            <li>Normalerweise <strong>trinke ich</strong> Wasser.</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">23 Vowel change in some verbs</h3>
    <div>
        <p>A few common verbs change the vowel in the <strong>second and third person singular</strong>.</p>
        <p>Here is the table for a verb without vowel change:</p>
        <table class="table">
            <thead>
            <tr>
                <th>En. person</th>
                <th>person</th>
                <th><em>trinken</em></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>ich</td>
                <td>trink<strong>e</strong></td>
            </tr>
            <tr>
                <td>you (sg.)</td>
                <td>du</td>
                <td>trink<strong>st</strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>er/sie/es</td>
                <td>trink<strong>t</strong></td>
            </tr>
            <tr>
                <td>we</td>
                <td>wir</td>
                <td>trink<strong>en</strong></td>
            </tr>
            <tr>
                <td>you (pl.)</td>
                <td>ihr</td>
                <td>trink<strong>t</strong></td>
            </tr>
            <tr>
                <td>they</td>
                <td>sie</td>
                <td>trink<strong>en</strong></td>
            </tr>
            </tbody>
        </table>
        <p>
            And here are three verbs with that vowel change. Notice that in the first two verbs, the 2nd and 3rd person
            singular seem the same. This is just because the <em>du</em> ending <em>-st</em> merged with the
            <em>-s-</em> of the verb stem. This is unrelated to the vowel change.
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>person</th>
                <th><em>lesen</em></th>
                <th><em>sprechen</em></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ich</td>
                <td>lese</td>
                <td>spreche</td>
            </tr>
            <tr>
                <td>du</td>
                <td><strong>liest</strong></td>
                <td>spr<strong>i</strong>chst</td>
            </tr>
            <tr>
                <td>er/sie/es</td>
                <td><strong>liest</strong></td>
                <td>spr<strong>i</strong>cht</td>
            </tr>
            <tr>
                <td>wir</td>
                <td>lesen</td>
                <td>sprechen</td>
            </tr>
            <tr>
                <td>ihr</td>
                <td>lest</td>
                <td>sprecht</td>
            </tr>
            <tr>
                <td>sie</td>
                <td>lesen</td>
                <td>sprechen</td>
            </tr>
            </tbody>
        </table>
        <p>Similarly, <em>essen</em> turns to <em>du isst/er isst</em>.</p>
        <p><em>Sprechen</em> (to speak) will be introduced in one of the next lessons.</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">24 <em>Isst</em> vs. <em>ist</em></h3>
    <div>
        <p>
            <em>Isst</em> and <em>ist</em> sound exactly the same. So do <em>Es ist ein Apfel.</em> and <em>
            Es isst ein
            Apfel.
        </em> sound the same?
        </p>
        <p>
            Yes, but you can tell it's <em>Es i<strong>s</strong>t ein Apfel</em>: <em>Es i<strong>ss</strong>t ein Apfel</em>
            is ungrammatical. The <strong>accusative</strong> of <em>ein Apfel</em> is <em>ein<strong>en</strong> Apfel</em>.
            Hence, <em>It is eating an apple</em> translates as <em>
            Es i<strong>ss</strong>t ein<strong>en</strong>
            Apfel
        </em>.
        </p>
        <p>
            Of course, this only works for <em>masculine</em> nouns. Other forms will look the same in nominative and
            accusative:
        </p>
        <ul>
            <li>Er isst eine Banane.</li>
            <li>Er ist eine Banane.</li>
        </ul>
        <p>Only context will tell you here :)</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">25 <em>Ich habe Brot</em></h3>
    <div>
        <p>
            In English, you can say "I'm having bread" when you really mean that you're eating or about to eat bread.
            <strong>This does not work in German.</strong> The verb <strong>
            <em>haben</em> refers to possession
            only.
        </strong> Hence, the sentence <em>Ich habe Brot</em> only translates to <em>I have bread</em>, not
            <em>I'm having bread.</em> Of course, the same applies to drinks. <em>Ich habe Wasser</em> only translates
            to <em>I have water,</em> not <em>I'm having water.</em>
        </p>
        <p>Conjugation is also slightly irregular: two forms lose the <em>-b-</em>.</p>
        <table class="table">
            <thead>
            <tr>
                <th>English person</th>
                <th>German example</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I</td>
                <td>ich habe</td>
            </tr>
            <tr>
                <td>you (sg.)</td>
                <td>du <strong>hast</strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>er/sie/es <strong>hat</strong></td>
            </tr>
            <tr>
                <td>we</td>
                <td>wir haben</td>
            </tr>
            <tr>
                <td>you (pl.)</td>
                <td>ihr habt</td>
            </tr>
            <tr>
                <td>they</td>
                <td>sie haben</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">26 Grammar break!</h3>
    <div>
        <p>
            There is no new grammar in this lesson. If you're confused, you can review the grammar points from earlier
            lessons.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white">27 Harness the power of other learners</h4>
    <div>
        <p>
            Or you can check the discussion that's available for each sentence. You can reach these when tapping or
            clicking on the speech bubble. Your question might already have been answered there. Otherwise, you can
            leave a comment yourself.
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">28 <em>Ich habe Hunger!</em></h3>
    <div>
        <p>
            As mentioned in the "Accusative" lesson, <em>haben</em> is not used in the sense of "I'm having bread" or
            "I'm having tea" in German. <em>Ich habe Brot</em> only translates to "I have bread".
        </p>
        <p>German uses <em>haben</em> in some instances where English uses "to be":</p>
        <ul>
            <li>
                <p>Ich <em>habe</em> Hunger. (I am hungry.)</p>
            </li>
            <li>
                <p>Ich <em>habe</em> Durst. (I am thirsty.)</p>
            </li>
            <li>
                <p>Sie <em>hat</em> Recht. (She is right.)</p>
            </li>
            <li>
                <p>Er <em>hat</em> Angst. (He is afraid.)</p>
            </li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">29 Compound words</h3>
    <div>
        <p>
            A compound word is a word that consists of two or more words. These are <strong>
            written as one word (no
            spaces)
        </strong>.
        </p>
        <p>
            The <strong>gender</strong> of a compound noun is always <strong>determined by its last element</strong>.
            This shouldn't be too difficult to remember, because the last element is always the most important one. All
            the previous elements merely describe the last element.
        </p>
        <ul>
            <li>
                <p><em>die</em> Auto<em>bahn</em> (das Auto + <em>die</em> Bahn)</p>
            </li>
            <li>
                <p><em>der</em> Orangen<em>saft</em> (die Orange + <em>der</em> Saft)</p>
            </li>
            <li>
                <p><em>das</em> Hunde<em>futter</em> (der Hund + <em>das</em> Futter)</p>
            </li>
        </ul>
        <p>Sometimes, there's a connecting sound (<em>Fugenlaut</em>) between two elements.</p>
        <ul>
            <li>
                <p>die Orange + der Saft = der Orange<em>n</em>saft</p>
            </li>
            <li>
                <p>der Hund + das Futter = das Hund<em>e</em>futter (the dog food)</p>
            </li>
            <li>
                <p>die Liebe + das Lied = das Liebe<em>s</em>lied (the love song)</p>
            </li>
            <li>
                <p>der Tag + das Gericht = das Tag<em>es</em>gericht (dish of the day)</p>
            </li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">30<em>Mittagessen</em> — lunch or dinner?</h3>
    <div>
        <p>
            We're aware that "dinner" is sometimes used synonymously with "lunch", but for the purpose of this course,
            we're defining <em>Frühstück</em> as "breakfast", <em>Mittagessen</em> as "lunch", and "dinner/supper" as
            <em>Abendessen</em> / <em>Abendbrot.</em>
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">31 Cute like sugar!</h3>
    <div>
        <p>The word <em>süß</em> means "sweet" when referring to food, and "cute" when referring to living beings.</p>
        <ul>
            <li>Der Zucker ist <em>süß</em>. (The sugar is <em>sweet</em>.)</li>
            <li>Die Katze ist <em>süß</em>. (The cat is <em>cute</em>.)</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">32 Does <em>Gemüse</em> mean "vegetable" or "vegetables"?</h3>
    <div>
        <p>
            In German, <em>Gemüse</em> is used as a mass noun. That means it's grammatically singular and takes a
            singular verb.
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">33 Recognizing noun gender</h3>
    <div>
        <p>
            While noun genders might seem random for many words, there are quite a few ways to at least land a likely
            hit.
        </p>
        <p>
            For example, many German nouns have some kind of ending, which will always or often come with a particular
            gender.
        </p>
        <ul>
            <li>
                <p>
                    <strong>Non-living objects that end in <em>-e</em></strong>: these will almost always be <strong>feminine</strong>
                    (<em>Schokolade, Erdbeere, Orange, Banane, Suppe, …</em>). One of the very few exceptions is <em>
                    der
                    Käse
                </em>. This also works for many, but not all animals (<em>
                    die Katze, Ente, Spinne, Biene,
                    Fliege, …
                </em>).
                </p>
            </li>
            <li>
                <p>
                    Nouns <strong>beginning with <em>Ge-</em></strong> are often <strong>neuter</strong>. This is the
                    only prefix determining gender. (<em>das Gemüse, …</em>)
                </p>
            </li>
        </ul>
        <p>There are many more endings like these. You will learn more about them throughout this course.</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">34 <em>Fressen</em> vs. <em>essen</em></h3>
    <div>
        <p>
            Unlike English, German has two similar but different verbs for "to eat": <em>essen</em> and <em>fressen</em>.
            The latter is the standard way of expressing that an animal is eating something. Be careful
            <strong>not</strong> to use <em>fressen</em> to refer to humans – this would be a serious insult. Assuming
            you care about politeness, we will not accept your solutions if you use <em>fressen</em> with human
            subjects.
        </p>
        <p>
            The most common way to express that a human being is eating something is the verb <em>essen</em>. It is not
            wrong to use it for animals as well, so we will accept both solutions. But we strongly recommend you
            accustom yourself to the distinction between <em>essen</em> and <em>fressen</em>.
        </p>
        <p>Fortunately, both verbs have the same conjugation:</p>
        <table class="table">
            <thead>
            <tr>
                <th><em>essen</em></th>
                <th><em>fressen</em> (for animals)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ich esse</td>
                <td>ich fresse</td>
            </tr>
            <tr>
                <td>du isst</td>
                <td>du frisst</td>
            </tr>
            <tr>
                <td>er/sie/es isst</td>
                <td>er/sie/es frisst</td>
            </tr>
            <tr>
                <td>wir essen</td>
                <td>wir fressen</td>
            </tr>
            <tr>
                <td>ihr esst</td>
                <td>ihr fresst</td>
            </tr>
            <tr>
                <td>sie essen</td>
                <td>sie fressen</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row d-block">

</body>
</html>