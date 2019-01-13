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
    <title>Downloaded grammar 3</title>
    <link rel="stylesheet" href="duolingo.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body class="container">
<div class="row d-block">
    <h1 class="p-2 mt-5 mb-2 bg-success text-white">Duolingo German Tips and Notes</h1>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" >1 Personal Pronouns in the Nominative Case</h3>
    <div id='1'>
        <p>
            A pronoun is a word that represents a noun, like <em>er</em> does for <em>der Mann</em>. In the nominative
            case, the personal pronouns are simply the grammatical persons you already know: <em>ich</em>, <em>du</em>,
            <em>er/sie/es</em>, <em>wir</em>, <em>ihr</em>, and <em>sie</em>.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" >2 Possessive pronouns</h4>
    <div id='2'>
        <span >
        <table class="table" id='test1' >
            <thead>
            <tr>
                <th>personal pronouns</th>
                <th>possessive pronouns</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>ich</td>
                <td>mein</td>
            </tr>
            <tr>
                <td>du</td>
                <td>dein</td>
            </tr>
            <tr>
                <td>er/es</td>
                <td>sein</td>
            </tr>
            <tr>
                <td>sie (feminine)</td>
                <td>ihr</td>
            </tr>
            <tr>
                <td>wir</td>
                <td>unser</td>
            </tr>
            <tr>
                <td>ihr</td>
                <td>euer</td>
            </tr>
            <tr>
                <td>sie (plural)</td>
                <td>ihr</td>
            </tr>
            </tbody>
        </table>
       </span>
       
        <table class="table" id='test2'>
            <thead>
            <tr>
                <th></th>
                <th><em>der</em> Hund</th>
                <th><em>das</em> Insekt</th>
                <th><em>die</em> Katze</th>
                <th><em>die</em> Hunde</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>indef. article</td>
                <td>ein</td>
                <td>ein</td>
                <td>ein<strong>e</strong></td>
                <td>(kein<strong>e</strong>)</td>
            </tr>
            <tr>
                <td>ich</td>
                <td>mein</td>
                <td>mein</td>
                <td>mein<strong>e</strong></td>
                <td>mein<strong>e</strong></td>
            </tr>
            <tr>
                <td>du</td>
                <td>dein</td>
                <td>dein</td>
                <td>dein<strong>e</strong></td>
                <td>dein<strong>e</strong></td>
            </tr>
            <tr>
                <td>er/es</td>
                <td>sein</td>
                <td>sein</td>
                <td>sein<strong>e</strong></td>
                <td>sein<strong>e</strong></td>
            </tr>
            <tr>
                <td>sie (fem.)</td>
                <td>ihr</td>
                <td>ihr</td>
                <td>ihr<strong>e</strong></td>
                <td>ihr<strong>e</strong></td>
            </tr>
            <tr>
                <td>wir</td>
                <td>unser</td>
                <td>unser</td>
                <td>unser<strong>e</strong></td>
                <td>unser<strong>e</strong></td>
            </tr>
            <tr>
                <td>ihr</td>
                <td>euer</td>
                <td>euer</td>
                <td>eu<strong>re</strong></td>
                <td>eu<strong>re</strong></td>
            </tr>
            <tr>
                <td>sie (plural)</td>
                <td>ihr</td>
                <td>ihr</td>
                <td>ihr<strong>e</strong></td>
                <td>ihr<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
        
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='3'>3 Demonstrative Pronouns</h4>
    <div id='rule3'>
       That means, der, die and das can also mean "that (one)" or "this (one)" depending on the gender of the respective noun, and "die" (plural) can mean "these" or "those." 
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='4'>4 Some other pronouns</h3>
    <div id='table4'>
        
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>der</th>
                <th>das</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>this/these</td>
                <td>dies<strong>er</strong></td>
                <td>dies<strong>es</strong></td>
            </tr>
            <tr>
                <td>every</td>
                <td>jed<strong>er</strong></td>
                <td>jed<strong>es</strong></td>
            </tr>
            <tr>
                <td>some</td>
                <td>manch<strong>er</strong></td>
                <td>manch<strong>es</strong></td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th>die (fem.)</th>
                <th>die (pl.)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>dies<strong>e</strong></td>
                <td>dies<strong>e</strong></td>
            </tr>
            <tr>
                <td>jed<strong>e</strong></td>
                <td>---</td>
            </tr>
            <tr>
                <td>manch<strong>e</strong></td>
                <td>manch<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
  
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='5'>Use viel with uncountable nouns, viele with countable ones</h3>
    <div>
        <p>
            These roughly correspond to English "much/many". Use <em>viel</em> with uncountable nouns, <em>viele</em>
            with countable ones.
        </p>
        <ul>
            <li>Ich trinke <strong>viel</strong> Wasser.</li>
            <li>Ich habe <strong>viele</strong> Hunde.</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='6'>Just like nicht (not) has a look-alike nichts (nothing), alle (all) has alles (everything) as a counterpart. </h3>
    <div>
        <p>
            Just like <em>nicht</em> (not) has a look-alike <em>nicht<strong>s</strong></em> (nothing), <em>alle</em>
            (all) has <em>alle<strong>s</strong></em> (everything) as a counterpart.
        </p>
        <ul>
            <li>Ich esse <strong>nicht</strong>. (I do not eat.)</li>
            <li>Ich esse <strong>nichts</strong>. (I eat nothing.)</li>
            <li>Ich esse <strong>alles</strong>. (I eat everything.)</li>
            <li>Ich esse <strong>alle</strong> (Orangen). (I eat all (oranges).)</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='7'>7<em>Ein paar</em> vs. <em>ein Paar</em></h3>
    <div>
        <p>
            <em>Ein paar</em> (lowercase <em>p</em>) means "a few", "some" or "a couple (of)" (only in the sense of
            <strong>at least two, not exactly two!</strong>).
        </p>
        <p>
            <em>Ein Paar</em> (uppercase <em>P</em>) means "a pair (of)" and is only used for things that typically come
            in pairs of two, e.g. <em>ein Paar Schuhe</em> (a pair of shoes).
        </p>
        <p>So this is quite similar to English "a couple" (a pair) vs. "a couple of" (some).</p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='8'>8 German Negatives</h3>
    <div>
        <p>
            There are different ways to negate expressions in German (much like in English you can use "no" in some
            cases, and "does not" in others). The German adverb <em>nicht</em> (not) is used very often, but sometimes
            you need to use <em>kein</em> (not a).
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='9'>
    If you can use "not a/no" in English, use kein.
    If you need to use "not", use nicht.
</h4>
    <div>
        <p>As mentioned in the lesson "Not", you should use <em>nicht</em> in the following situations:</p>
        <ul>
            <li>
                Negating a <strong>noun that has a definite article</strong> like <em>der Junge</em> (the boy) in <em>
                Das
                ist nicht der Junge.
            </em> (That is not the boy).
            </li>
            <li>
                Negating a <strong>noun that has a possessive pronoun</strong> like <em>mein Glas</em> (my glass) in
                <em>Das ist nicht mein Glas.</em> (That is not my glass).
            </li>
            <li>Negating <strong>the verb</strong>: <em>Ich <strong>trinke</strong> nicht.</em> (I do not drink.).</li>
            <li>
                Negating <strong>an adverb or adverbial phrase</strong>. For instance, <em>
                Ich tanze nicht
                <strong>oft</strong>.
            </em> (I do not dance often)
            </li>
            <li>
                Negating <strong>an adjective that is used with <em>sein</em></strong> (to be): <em>
                Ich bin nicht
                <strong>hungrig</strong>
            </em>. (I am not hungry).
            </li>
        </ul>
        <p>For details, and to learn where to put <em>nicht</em> in a sentence, refer to the "Not" lesson.</p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='10'>
    If you can use "not a/no" in English, use kein.
    If you need to use "not", use nicht.
</h4>
    <div>
        <p>
            Simply put, <strong><em>kein</em> is composed of <em>k + ein</em></strong> and placed where the indefinite
            article would be in a sentence. <strong>If you want to negate <em>ein</em>, use <em>kein</em></strong>.
        </p>
        <p>
            Just like <em>mein</em> and the other possessive pronouns, <strong><em>kein</em> changes its ending like <em>ein</em></strong>.
        </p>
        <p>For instance, look at the positive and negative statement about these two nouns:</p>
        <ul>
            <li>Er ist ein Mann. (He is a man) — Sie ist kein Mann. (She is not a/no man.)</li>
            <li>Ich habe ein<em>e</em> Katze. (I have a cat.) — Ich habe kein<em>e</em> Katze. (I have no cat.)</li>
        </ul>
        <p>Here are the endings of the indefinite article so far:</p>
        <span id='table10' >
        <table class="table" >
            <thead>
            <tr>
                <th></th>
                <th>masc</th>
                <th>neut</th>
                <th>fem</th>
                <th>plural</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>nominative</td>
                <td>ein</td>
                <td>ein</td>
                <td>ein<strong>e</strong></td>
                <td>---</td>
            </tr>
            <tr>
                <td>accusative</td>
                <td>ein<strong>en</strong></td>
                <td>ein</td>
                <td>ein<strong>e</strong></td>
                <td>---</td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>masc</th>
                <th>neut</th>
                <th>fem</th>
                <th>plural</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>nominative</td>
                <td>kein</td>
                <td>kein</td>
                <td>kein<strong>e</strong></td>
                <td>kein<strong>e</strong></td>
            </tr>
            <tr>
                <td>accusative</td>
                <td>kein<strong>en</strong></td>
                <td>kein</td>
                <td>kein<strong>e</strong></td>
                <td>kein<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
    </span>
        <p>
            <em>Kein</em> is also used for <strong>negating nouns that have no article</strong>: <em>Er hat Brot.</em>
            (He has bread.) versus <em>Er hat kein Brot.</em> (He has no bread.).
        </p>
        <p>As a general rule:</p>
        <ul>
            <li>If you <strong>can use "not a/no" in English, use <em>kein</em></strong>.</li>
            <li>If you <strong>need to use "not", use <em>nicht</em></strong>.</li>
        </ul>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='11'>
    If you can use "not a/no" in English, use kein.
    If you need to use "not", use nicht.
</h4>
    <div>
        <p>
            <em>Nicht</em> is an adverb and is useful for negations. On the other hand, <em>nicht<strong>s</strong></em>
            (nothing/anything) is a pronoun and its meaning is different from that of <em>nicht</em>.
        </p>
        <ul>
            <li>Ich esse <em>nicht</em>. (I do not eat.)</li>
            <li>Ich esse <em>nichts</em>. (I eat nothing.)</li>
        </ul>
        <p>
            Using <em>nicht</em> simply negates a fact, and is less overarching than <em>nichts</em>. For example, <em>
            Der
            Schüler lernt nicht.
        </em> (The student does not learn.) is less extreme than <em>
            Der Schüler lernt
            nichts.
        </em> (The student does not learn anything.).
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='12'>12<em>Keiner, keine, keines</em></h4>
    <div>
        <p>In German, "nobody" can be expressed in several ways.</p>
        <p>As long as at refers to people, <em>niemand</em> works just fine:</p>
        <ul>
            <li>Niemand schläft. (Nobody sleeps.)</li>
        </ul>
        <p>There is also <em>keiner</em>. It changes endings like the definite articles:</p>
        <table class="table" >
            <thead>
            <tr>
                <th></th>
                <th>masc.</th>
                <th>neut.</th>
                <th>fem.</th>
                <th>plural</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>nominative</td>
                <td>de<strong>r</strong></td>
                <td>da<strong>s</strong></td>
                <td>di<strong>e</strong></td>
                <td>di<strong>e</strong></td>
            </tr>
            <tr>
                <td>accusative</td>
                <td>de<strong>n</strong></td>
                <td>da<strong>s</strong></td>
                <td>di<strong>e</strong></td>
                <td>di<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>masc.</th>
                <th>neut.</th>
                <th>fem.</th>
                <th>plural</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>nominative</td>
                <td>kein<strong>er</strong></td>
                <td>kein<strong>es</strong></td>
                <td>kein<strong>e</strong></td>
                <td>kein<strong>e</strong></td>
            </tr>
            <tr>
                <td>accusative</td>
                <td>kein<strong>en</strong></td>
                <td>kein<strong>es</strong></td>
                <td>kein<strong>e</strong></td>
                <td>kein<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
        <p>For now, we teach only the default version (which is <em>masculine</em> in German):</p>
        <ul>
            <li>Keiner schläft. (None of them sleeps.)</li>
        </ul>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='13'>13 How do you like things in German?</h3>
    <div>
        <p>
            Use the verb <em>mögen</em> to express that you like something or someone, and use the adverb
            <em>gern(e)</em> to express that you like doing something.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='14' >14<em>Mögen</em> is used for things, animals, and people:</h4>
    <div>
        <ul>
            <li>
                <p>Ich mag Bier. (I like beer.)</p>
            </li>
            <li>
                <p>Sie mag Katzen. (She likes cats.)</p>
            </li>
            <li>
                <p>Wir mögen dich. (We like you.)</p>
            </li>
            <li>
                <p>Ihr mögt Bücher. (You like books.)</p>
            </li>
        </ul>
        <p>Please refer to lesson "Present 1" for more details on <em>mögen</em>.</p>

        <table class="table" id='table14'>
            <thead>
            <tr>
                <th>English</th>
                <th>pronoun</th>
                <th>wollen</th>
                <th>mögen</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>I want/like</td>
                <td>ich</td>
                <td>w<strong>i</strong>ll</td>
                <td>m<strong>a</strong>g</td>
            </tr>
            <tr>
                <td>you (sg. inf.)</td>
                <td>du</td>
                <td>w<strong>i</strong>ll<strong>st</strong></td>
                <td>m<strong>a</strong>g<strong>st</strong></td>
            </tr>
            <tr>
                <td>he/she/it</td>
                <td>er/sie/es</td>
                <td>w<strong>i</strong>ll</td>
                <td>m<strong>a</strong>g</td>
            </tr>
            <tr>
                <td>we</td>
                <td>wir</td>
                <td>w<strong>o</strong>ll<strong>en</strong></td>
                <td>m<strong>ö</strong>g<strong>en</strong></td>
            </tr>
            <tr>
                <td>you (pl. inf.)</td>
                <td>ihr</td>
                <td>w<strong>o</strong>ll<strong>t</strong></td>
                <td>m<strong>ö</strong>g<strong>t</strong></td>
            </tr>
            <tr>
                <td>they</td>
                <td>sie</td>
                <td>w<strong>o</strong>ll<strong>en</strong></td>
                <td>m<strong>ö</strong>g<strong>en</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='15'>Gern(e) is used for verbs/activities:</h4>
    <div>
        <ul>
            <li>
                <p>Ich trinke gern(e) Bier. (I like to drink beer/I like drinking beer.)</p>
            </li>
            <li>
                <p>Er spielt gern(e) Fußball. (He likes to play soccer/He likes playing soccer.)</p>
            </li>
            <li>
                <p>Wir lesen gern(e) Bücher. (We like to read books/We like reading books.)</p>
            </li>
            <li>
                <p>Sie schreibt gern(e) Briefe. (She likes to write letters/She likes writing letters.)</p>
            </li>
        </ul>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='16'>16 Position of <em>gerne</em></h4>
    <div>
        <p>
            If you're not sure <strong>where to put <em>gern(e)</em></strong>: It goes to the same position as
            <em>oft</em> (often).
        </p>
        <ul>
            <li>Ich trinke <strong>oft</strong> Bier. (I drink beer often.)</li>
            <li>Ich trinke <strong>gern</strong> Bier. (I like to drink beer.)</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='17'>17<em>Gern/gerne</em>, <em>allein/alleine</em></h3>
    <div>
        <p>
            What's the difference between <strong><em>gern</em> and *gerne</strong>*? They're just variations of the same
            word. There's no difference in terms of meaning or style. You can use whichever you like best.
        </p>
        <p>The same goes for <em>allein(e)</em>. </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='18'>18 Position of <em>auch</em></h3>
    <div>
        <p><em>Auch</em> corresponds to English "also, too".</p>
        <p>
            The positioning follows different rules in both languages. Soon you will learn more about the peculiarities
            of German sentence structure. For now, remember that <em>auch</em> takes roughly the same position as <em>nicht</em>.
            When both occur together, <em>auch</em> will come before <em>nicht</em>.
        </p>
        <p>Consider these two examples to get a first idea about this:</p>
        <ul>
            <li>
                <p>
                    Ich laufe. Du läufst <strong>auch</strong>. Er läuft <strong>nicht</strong>. Sie läuft <strong>
                    auch
                    nicht
                </strong>.
                </p>
            </li>
            <li>
                <p>
                    Ich komme aus China. Du kommst <strong>auch</strong> aus China. Er kommt <strong>nicht</strong> aus
                    China. Sie kommt <strong>auch nicht</strong> aus China.
                </p>
            </li>
        </ul>
        <p>Here's one more adverb, to see how they work together:</p>
        <ul>
            <li>
                Ich trinke <strong>oft</strong> Bier. Du trinkst <strong>auch oft</strong> Bier. Er trinkt <strong>
                nicht
                oft
            </strong> Bier. Sie trinkt <strong>auch nicht oft</strong> Bier.
            </li>
        </ul>
        <p>
            For reasons that will become clearer soon, <em>Sie kommt aus China <strong>auch</strong>.</em> is <strong>
            not
            a valid sentence
        </strong> in German.
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='19'>19 Recognizing noun gender</h3>
    <div>
        <p>
            As mentioned before, you can often know the <strong>gender of a noun</strong> by <strong>
            looking at the word
            ending
        </strong>.
        </p>
        <ul>
            <li>
                non-living objects that end in <em>-e</em>: these will almost always be feminine (<em>
                die Lampe,
                Schokolade, Erdbeere, Orange, Banane, Suppe, Hose, Jacke, Sonne, Straße, Brücke, Schule, …
            </em>)
            </li>
            <li>
                nouns beginning with <em>Ge-</em> are often neuter. This is the only prefix determining gender. (<em>
                das
                Gebäude, Gemüse, Gesicht, Gesetz, …
            </em>)
            </li>
        </ul>
        <p>
            In addition, rhyming can often help. If you already know a noun that rhymes with the new one, there's a good
            chance they will have the same gender. Go for it :)
        </p>
        <ul>
            <li>der Fisch, der Tisch</li>
            <li>der Raum, der Traum, der Baum</li>
            <li>der Kopf, der Knopf</li>
        </ul>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='20'>20 Pronunciation of French loanwords</h3>
    <div>
        <p>
            When English uses a word from French, it usually pronounces it according to English sound rules. German will
            often sound more close to the original.
        </p>
        <p>
            An example for this is <em>Restaurant</em>. Like in French, the last syllable will sound roughly like "raw".
            The <em>-t</em> will be silent. Some people will pronounce the ending similar to English "rung" instead. Of
            course, the <em>R-</em> will sound like the German <em>r</em>, not the English one.
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='21'>21 Combining stuff</h3>
    <div>
        <p>
            German is well known for its long words that can be made up on the go by concatenating existing words. In
            this skill you will learn one very simple and commonly used way of forming compounds: adding <em>-zeug</em>
            (="stuff") to existing words.
        </p>
        <p>
            Remember that the last element determines gender and plural. So all new words in this lesson will be
            neuter.
        </p>
        <p>OK, because you asked: the longest "real" German word (so far) is:</p>
        <ul>
            <li>Rindfleisch-etikettierungs-überwachungs-aufgaben-übertragungs-gesetz</li>
        </ul>
        <p>(Without the hyphens. We had to add those in order to be able to show the whole word…)</p>
        <p>
            It's a law on how to transfer tasks about the monitoring of the labeling of beef. At least that's what the
            word says.
        </p>
        <p>If you enjoyed this, check out "Rhabarberbarbara" on Youtube.</p>
        <p>No, words like this don't normally happen in German :)</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='22'>22 How much stuff?</h3>
    <div>
        <p>
            In English, you can't count "stuff" -- you can't use the plural "stuffs" or say that "there are three stuffs
            on the floor". Instead, "stuff" is a collective noun, referring to a group of things but used in the
            singular: "there is stuff on the floor".
        </p>
        <p>
            Some German <em>-zeug</em> words can work like this as well -- for example, <em>Spielzeug</em> and <em>Werkzeug</em>
            in the singular, without an article, mean "toys" and "tools", which are plural in English.
        </p>
        <p>
            Those words can also be used in a countable way: <em>ein Spielzeug, zwei Werkzeuge</em> "one toy, two tools".
            So "the tools" could be either <em>das Werkzeug</em> or <em>die Werkzeuge</em> -- the former would view the
            tools as a group, the latter would consider them individually.
        </p>
        <p>
            Look out for whether there is an indefinite article or number before the singular word to see whether it's
            used countably or uncountably.
        </p>
        <p>
            If there's a possessive word or a definite article before such a noun in the singular, it could be either:
            <em>mein Werkzeug ist neu</em> could mean either "My tool is new" or "My tools are new", for example;
            similarly with <em>das Werkzeug ist neu</em> which could be either "The tools is new" or "The tools are
            new".
        </p>
        <p>
            (An English word that works similarly is "fruit" -- "my fruit" could refer to just one apple, or it could
            refer to two apples and a banana all together, depending on whether "fruit" is used countably or
            uncountably.)
        </p>
        <p>
            Other <em>-zeug</em> words are always regular countable words, such as <em>Flugzeug</em> "airplane" or <em>Feuerzeug</em>
            "lighter".
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white">  22 Pronouns</h3>
    <div>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='23'>23 Personal Pronouns in the Accusative Case</h4>
    <div>
        <p>
            Aside from the nominative case, most of the German <strong>pronouns are declined</strong> according to case.
            Like in English, when the <strong>subject becomes the object</strong>, <strong>the pronoun changes</strong>.
            For instance, <em>ich</em> changes to <em>mich</em> (accusative object) as in <em>Sie sieht mich.</em> (She
            sees me.).
        </p>
        <table class="table" id='table23'>
            <thead>
            <tr>
                <th>Nominative (subject)</th>
                <th>Accusative (object)</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>ich</strong> (I)</td>
                <td><strong>mich</strong> (me)</td>
            </tr>
            <tr>
                <td><strong>du</strong> (you singular informal)</td>
                <td><strong>dich</strong> (you singular informal)</td>
            </tr>
            <tr>
                <td><strong>er</strong> (he) <strong>sie</strong> (she) <strong>es</strong> (it)</td>
                <td><strong>ihn</strong> (him) <strong>sie</strong> (her) <strong>es</strong> (it)</td>
            </tr>
            <tr>
                <td><strong>wir</strong> (we)</td>
                <td><strong>uns</strong> (us)</td>
            </tr>
            <tr>
                <td><strong>ihr</strong> (you plural informal)</td>
                <td><strong>euch</strong> (you plural informal)</td>
            </tr>
            <tr>
                <td><strong>sie</strong> (they)</td>
                <td><strong>sie</strong> (them)</td>
            </tr>
            </tbody>
        </table>
        <p>
            Notice that apart from masculine singular, the <strong>third person forms are the same</strong> in nominative
            and accusative. The masculine form, which does change, has the same endings as the definite article
            (<em>de<strong>r</strong></em> becomes <em>de<strong>n</strong></em>).
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='24' >24 Possessive Pronouns in the Accusative Case</h4>
    <div>
        <p>
            You might remember from the lesson "Personal Pronouns" that German possessive pronouns change their endings
            like the indefinite article:
        </p>
        <ul>
            <li><em>ein</em> Hund, <em>mein</em> Hund</li>
            <li><em>eine</em> Katze, <em>meine</em> Katze</li>
        </ul>
        <p>
            This extends to all cases. You already know that <strong>
            in the accusative case, only masculine singular
            changes
        </strong>:
        </p>
        <ul>
            <li><strong>Ein</strong> Hund schläft. Er sieht <strong>einen</strong> Hund.</li>
        </ul>
        <p>but:</p>
        <ul>
            <li><strong>Eine</strong> Katze schläft. Sie sieht <strong>eine</strong> Katze. (no change)</li>
        </ul>
        <p>
            So, if you see <em>ein<strong>en</strong></em>, <em>mein<strong>en</strong></em>,
            <em>unser<strong>en</strong></em> and so forth with a singular noun, you will know two things:
        </p>
        <ul>
            <li>the noun is masculine</li>
            <li>the noun is in the accusative case (probably the object of the sentence)</li>
        </ul>
        <p>Consider this example:</p>
        <ul>
            <li>Meinen Hund mag die Frau nicht.</li>
        </ul>
        <p>
            It is clear here that the dog must be the object (accusative). So actually the woman does not like the
            dog.
        </p>
        <p>Here is the table of possessive pronouns for the accusative case:</p>
        <table class="table" id='table24'>
            <thead>
            <tr>
                <th>Accusative</th>
                <th><em>der</em> Hund</th>
                <th><em>das</em> Insekt</th>
                <th><em>die</em> Katze</th>
                <th><em>die</em> Hunde</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>indef. article</td>
                <td>ein<strong>en</strong></td>
                <td>ein</td>
                <td>ein<strong>e</strong></td>
                <td>(kein<strong>e</strong>)</td>
            </tr>
            <tr>
                <td>ich</td>
                <td>mein<strong>en</strong></td>
                <td>mein</td>
                <td>mein<strong>e</strong></td>
                <td>mein<strong>e</strong></td>
            </tr>
            <tr>
                <td>du</td>
                <td>dein<strong>en</strong></td>
                <td>dein</td>
                <td>dein<strong>e</strong></td>
                <td>dein<strong>e</strong></td>
            </tr>
            <tr>
                <td>er/es</td>
                <td>sein<strong>en</strong></td>
                <td>sein</td>
                <td>sein<strong>e</strong></td>
                <td>sein<strong>e</strong></td>
            </tr>
            <tr>
                <td>sie (fem.)</td>
                <td>ihr<strong>en</strong></td>
                <td>ihr</td>
                <td>ihr<strong>e</strong></td>
                <td>ihr<strong>e</strong></td>
            </tr>
            <tr>
                <td>wir</td>
                <td>unser<strong>en</strong></td>
                <td>unser</td>
                <td>unser<strong>e</strong></td>
                <td>unser<strong>e</strong></td>
            </tr>
            <tr>
                <td>ihr</td>
                <td>eu<strong>ren</strong></td>
                <td>euer</td>
                <td>eu<strong>re</strong></td>
                <td>eu<strong>re</strong></td>
            </tr>
            <tr>
                <td>sie (plural)</td>
                <td>ihr<strong>en</strong></td>
                <td>ihr</td>
                <td>ihr<strong>e</strong></td>
                <td>ihr<strong>e</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='25'>25 Other declining words</h3>
    <div>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white"  >26 <em>Viel</em> vs. <em>viele</em></h4>
    <div>
        <p id='26'>
            These roughly correspond to English "much/many". Use <em>viel</em> with uncountable nouns, <em>viele</em>
            with countable ones.
        </p>
        <ul>
            <li>Ich trinke <strong>viel</strong> Wasser.</li>
            <li>Ich habe <strong>viele</strong> Hunde.</li>
        </ul>
        <p>
            <em>Viele</em> changes endings like the articles. But because the plural forms are the same for nominative
            and accusative, for now it will look always the same.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='27' >Jeder changes endings like definite articles:</h4>
    <div>
        <p><em>Jeder</em> changes endings like definite articles:</p>
        <ul>
            <li>die Frau, jede Frau</li>
            <li>das Mädchen, jedes Mädchen</li>
            <li>der Mann, jeder Mann — de<strong>n</strong> Mann, jede<strong>n</strong> Mann (accusative)</li>
        </ul>
    </div>
</div>
<div class="row d-block">
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='28'>28 Möbel</h4>
    <div>
        <p>
            <em>Möbel</em> corresponds to English "furniture". While "furniture" is singular, <em>Möbel</em> is normally
            only used in the plural.
        </p>
        <ul>
            <li>Die Möbel sind super! (The furniture is great!)</li>
        </ul>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='29'>29 German Conjunctions</h3>
    <div>
        <p>A conjunction like <em>wenn</em> (when) or <em>und</em> (and) connects two parts of a sentence together. </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='30'>30 Coordinating conjunctions</h4>
    <div>
        <p>
            <strong>Coordinating conjunctions</strong> form a group of coordinators (like <em>und</em> (and),
            <em>aber</em> (but)), which combine two items of equal importance; here, each clause can stand on its own
            and the word order does not change.
        </p>
        <ul>
            <li>Ich mag Schokolade. Sie mag Pizza.</li>
            <li>Ich mag Schokolade <strong>und</strong> sie mag Pizza.</li>
        </ul>
        <p>Examples: <em>und, oder, aber, denn</em></p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='31'>31 Subordinating conjunctions</h4>
    <div>
        <p>
            <strong>Subordinating conjunctions</strong> combine an independent clause with a dependent clause; the
            dependent clause cannot stand on its own and its word order will be different than if it did. In these
            <strong>subordinate clauses</strong>, the verb switches from the second position to the last.
        </p>
        <ul>
            <li>Ich bin gesund. Ich <strong>laufe</strong> oft.</li>
            <li>
                <p>Ich bin gesund, <strong>weil</strong> ich oft <strong>laufe</strong>.</p>
            </li>
            <li>
                <p>Ich spreche gut Deutsch. Ich <strong>lerne</strong> oft Deutsch.</p>
            </li>
            <li>Ich spreche gut Deutsch, <strong>weil</strong> ich oft Deutsch <strong>lerne</strong>.</li>
        </ul>
        <p>Examples: <em>weil, wenn, dass, obwohl</em></p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='32'>32 Correlative conjunctions</h4>
    <div>
        <p>
            <strong>Correlative conjunctions</strong> work in pairs to join sentence parts of equal importance. For
            instance, <em>entweder...oder</em> (either...or) is such a pair and can be used like this: <em>
            Der Schuh ist
            entweder blau oder rot.
        </em> (This shoe is either blue or red.).
        </p>
        <p>In German, conjunctions do not change with the case (i.e. they are not declinable).</p>
        <ul>
            <li>Du trägst einen Rock. Du trägst eine Hose.</li>
            <li>
                <p>Du trägst <strong>entweder</strong> einen Rock <strong>oder</strong> eine Hose.</p>
            </li>
            <li>
                <p>Du wäschst den Rock. Du trägst eine Hose.</p>
            </li>
            <li><strong>Entweder</strong> du wäschst den Rock, <strong>oder</strong> du trägst eine Hose.</li>
            <li>Du wäschst <strong>entweder</strong> den Rock <strong>oder</strong> (du) trägst eine Hose.</li>
        </ul>
        <p>Examples: <em>entweder … oder, nicht nur … sondern auch, weder … noch</em></p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='33'>Sondern works like "but … instead" in English. It only takes the element that is different:</h4>
    <div>
        <p><em>Sondern</em> works like "but … instead" in English. It only takes the element that is different:</p>
        <ul>
            <li>Ich trage <em>kein Kleid</em>. Ich trage <em>eine Hose</em>.</li>
            <li>
                <p>Ich trage <em>kein Kleid</em>, <em><strong>sondern</strong> eine Hose</em>.</p>
            </li>
            <li>
                <p>Sie kommt nicht <em>aus Deutschland</em>. Sie kommt <em>aus China</em>.</p>
            </li>
            <li>Sie kommt nicht <em>aus Deutschland</em>, <em><strong>sondern</strong> aus China</em>.</li>
        </ul>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='34'>34 Leute</h3>
    <div>
        <p>
            In English, you refer to one "person", but multiple "people". In German, <em>Leute</em> is also only used in
            the plural. The singular is <em>eine Person</em>.
        </p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='35'>35 Ich bin Türke. Ich komme aus Berlin.</h3>
    <div>
        <p>
            Germany has many Turkish people. These are not necessarily from Turkey. Most have had their parents or even
            their grandparents born in Germany.
        </p>
    </div>
</div>
<div class="row d-block">
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" >36 Yes/No Questions</h3>
    <div >
        <p id='36'>Questions can be asked by <strong>switching the subject and verb</strong>. </p>
        <ul>
            <li><em>Du verstehst</em> das. (You understand this.)</li>
        </ul>
        <p>becomes</p>
        <ul>
            <li><em>Verstehst du</em> das? (Do you understand this?).</li>
        </ul>
        <p>
            These kinds of questions will generally just elicit yes/no answers. In English, the main verb "to be" follows
            the same principle. "You are hungry." becomes "Are you hungry?".
        </p>
        <p>In German, all verbs follow this principle. <strong>There's no do-support</strong>.</p>
    </div>
    <h3 class="p-2 mt-5 mb-2 bg-info text-white" id='37'>37 Asking a Question in German With a W-Word</h3>
    <div>
        <p>There are seven W-questions in German:</p>
        <table class="table" id='table37'>
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>what</td>
                <td>was</td>
            </tr>
            <tr>
                <td><strong>who</strong></td>
                <td><strong>wer</strong></td>
            </tr>
            <tr>
                <td><strong>where</strong></td>
                <td><strong>wo</strong></td>
            </tr>
            <tr>
                <td>when</td>
                <td>wann</td>
            </tr>
            <tr>
                <td>how</td>
                <td>wie</td>
            </tr>
            <tr>
                <td>why</td>
                <td>warum</td>
            </tr>
            <tr>
                <td>which</td>
                <td>welcher</td>
            </tr>
            </tbody>
        </table>
        <p>Don't mix up <em>wer</em> and <em>wo</em>, which are "switched" in English :)</p>
        <p>Some of these will change according to case.</p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='38'>38 <em>Was</em> (what)</h4>
    <div>
        <p>
            If you ask <em>was</em> with a preposition, the two normally turn into a new word, according to the following
            pattern:
        </p>
        <table class="table" id='table38'>
            <thead>
            <tr>
                <th>English</th>
                <th>preposition</th>
                <th>wo-</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>for what</td>
                <td>für</td>
                <td>wofür</td>
            </tr>
            <tr>
                <td>about what</td>
                <td>über</td>
                <td>wo<strong>r</strong>über</td>
            </tr>
            <tr>
                <td>with what</td>
                <td>mit</td>
                <td>wo<strong>mit</strong></td>
            </tr>
            </tbody>
        </table>
        <p>
            If the preposition starts with a vowel, there will be an extra <em>-r-</em> to make it easier to pronounce.
        </p>
        <p>This <em>wo-</em> prefix does <strong>not</strong> mean "where".</p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='39'>39 <em>Wer</em> (who)</h4>
    <div>
        <p>
            <em>Wer</em> is declinable and needs to <strong>adjust to the cases</strong>. The adjustment depends on what
            the question is targeting.
        </p>
        <p>If you ask for the subject of a sentence (i.e. the nominative object), <em>wer</em> (who) remains as is:</p>
        <ul>
            <li><em>Wer</em> ist da? (Who is there?).</li>
        </ul>
        <p>
            If you ask for the direct (accusative) object in a sentence, <em>wer</em> changes to <em>wen</em> (who/whom).
            As a mnemonic, notice how <em>wen</em> rhymes with <em>den</em> in <em>den Apfel</em>.
        </p>
        <ul>
            <li><em>Wen</em> siehst du? — Ich sehe <em>den</em> Hund.</li>
            <li>(Whom do you see? — I see the dog.)</li>
        </ul>
        <p>
            You will soon learn about the Dative case. You have to use <em>wem</em> then. And there is a forth case in
            German (Genitive). You would use <em>wessen</em> here. This corresponds to English "whose".
        </p>
        <p>The endings look like the endings of <em>der</em> (but don't change with gender/number):</p>
        <table class="table" id='table39'>
            <thead>
            <tr>
                <th>case</th>
                <th>masc.</th>
                <th>Form of <em>wer</em></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>nominative</td>
                <td>der</td>
                <td>wer</td>
            </tr>
            <tr>
                <td>accusative</td>
                <td>den</td>
                <td>wen</td>
            </tr>
            <tr>
                <td>dative</td>
                <td>dem</td>
                <td>wem</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='40'>40 <em>Welche(r/s)</em> (which)</h4>
    <div>
        <p>
            <em>Welche-</em> words are used to ask about for a specific item out of a group of items, such as "which car
            is yours?".
        </p>
        <p>This declines not only for case, but also for gender. The endings are the same as for definite articles:</p>
        <table class="table" id='table40'>
            <thead>
            <tr>
                <th>article</th>
                <th>welch*</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>de<strong>r</strong></td>
                <td>welche<strong>r</strong></td>
            </tr>
            <tr>
                <td>da<strong>s</strong></td>
                <td>welche<strong>s</strong></td>
            </tr>
            <tr>
                <td>di<strong>e</strong></td>
                <td>welch<strong>e</strong></td>
            </tr>
            <tr>
                <td>di<strong>e</strong> (pl.)</td>
                <td>welch<strong>e</strong></td>
            </tr>
            <tr>
                <td>de<strong>n</strong></td>
                <td>welche<strong>n</strong></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='41'>41 <em>Wo</em> (where)</h4>
    <div>
        <p>In German, you can inquire about locations in several ways.</p>
        <p>
            <em>Wo</em> (where) is the general question word, but if you are <strong>asking for a direction</strong> in
            which someone or something is moving, you may <strong>use *wohin</strong>* (where to).
        </p>
        <p>Consider these examples:</p>
        <ul>
            <li>
                <p><em>Wo</em> ist mein Schuh? (Where is my shoe?)</p>
            </li>
            <li>
                <p><em>Wohin</em> gehst du? (Where are you going (to)?)</p>
            </li>
        </ul>
        <p>Furthermore, <em>wohin</em> is separable into <em>wo</em> + <em>hin</em>:</p>
        <ul>
            <li><em>Wo</em> ist mein Schuh <em>hin</em>? (Where did my shoe go?)</li>
        </ul>
        <p>The same goes for <em>woher</em> (where from):</p>
        <ul>
            <li><em>Woher</em> kommst du? (Where are you from)</li>
        </ul>
        <p>might become</p>
        <ul>
            <li><em>Wo</em> kommst du <em>her</em>?</li>
        </ul>
        <table class="table" id='table41'>
            <thead>
            <tr>
                <th>English</th>
                <th>German</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>where</td>
                <td>wo</td>
            </tr>
            <tr>
                <td>where to</td>
                <td>wo<em>hin</em></td>
            </tr>
            <tr>
                <td>where from</td>
                <td>wo<em>her</em></td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='42'>Don't confuse wann with wenn which you learned in Conjunctions. Both translate to "when" in English, but they have different functions in German. </h4>
    <div>
        <p>
            <em>Wann</em> (when) does not change depending on the case. <em>Wann</em> can be used with conjunctions such
            as <em>seit</em> (since) or <em>bis</em> (till):
        </p>
        <ul>
            <li>
                <p><em>Seit wann</em> wartest du? (Since when have you been waiting?)</p>
            </li>
            <li>
                <p><em>Bis wann</em> geht der Film? (Till when does the movie last?).</p>
            </li>
        </ul>
        <p>
            Don't confuse <em>w<strong>a</strong>nn</em> with <em>w<strong>e</strong>nn</em> which you learned in
            Conjunctions. Both translate to "when" in English, but they have different functions in German.
        </p>
        <ul>
            <li>
                <p><em>W<strong>a</strong>nn</em> kommst du? (When are you coming?)</p>
            </li>
            <li>
                <p>
                    Ich schlafe nicht, <em>w<strong>e</strong>nn</em> ich Musik höre. (I don't sleep when I listen to
                    music)
                </p>
            </li>
        </ul>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" >43<em>Warum</em> (why)</h4>
    <div>
        <p id='43'>
            <em>Warum</em> (why) is also not declinable. It will never change endings. <em>Wieso</em>, <em>Weshalb</em>,
            and <em>Weswegen</em> can be used instead of <em>Warum</em>. There's no difference in meaning.
        </p>
        <p>Here is an example. All four following sentences mean "Why is the car so old?".</p>
        <ul>
            <li>
                <p><em>Warum</em> ist das Auto so alt?</p>
            </li>
            <li>
                <p><em>Wieso</em> ist das Auto so alt?</p>
            </li>
            <li>
                <p><em>Weshalb</em> ist das Auto so alt?</p>
            </li>
            <li>
                <p><em>Weswegen</em> ist das Auto so alt?</p>
            </li>
        </ul>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" >44<em>Wie viel</em> vs. <em>wie viele</em></h4>
    <div>
        <p id='44'>
            <em>Wie viel</em> is used with uncountable or countable nouns (how much/how many), and <strong>
            <em>
                wie
                viele
            </em> is only used with countable nouns
        </strong> (how many). Some people think that "wie viel" can only
            be used with uncountable nouns, but that is not true.
        </p>
        <ul>
            <li>
                <p><em>Wie viel</em> Milch trinkst du? (How much milk do you drink?)</p>
            </li>
            <li>
                <p><em>Wie viel(e)</em> Tiere siehst du? (How many animals do you see?)</p>
            </li>
        </ul>
    </div>
</div>
<div class="row d-block">
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='45' >45 Informal and formal words for family members</h4>
    <div>
        <p>
            Just like in English, there are informal and formal words for "mother", "father", "grandmother", and
            "grandfather". Note that in German, the difference between formal and informal is a lot more pronounced than
            in English. The informal terms are pretty much only used within your own family.
        </p>
        <table class="table">
            <thead>
            <tr>
                <th>formal</th>
                <th>informal</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>die Mutter (the mother)</td>
                <td>die Mama (the mom)</td>
            </tr>
            <tr>
                <td>der Vater (the father)</td>
                <td>der Papa (the dad)</td>
            </tr>
            <tr>
                <td>die Großmutter (the grandmother)</td>
                <td>die Oma (the grandma)</td>
            </tr>
            <tr>
                <td>der Großvater (the grandfather)</td>
                <td>der Opa (the grandpa)</td>
            </tr>
            </tbody>
        </table>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='46'>You might notice that most members of the close family have their own "system" of plurals:</h4>
    <div>
        <p>You might notice that most members of the close family have their own "system" of plurals:</p>
        <table class="table">
            <thead>
            <tr>
                <th>singular</th>
                <th>plural</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>die M<strong>u</strong>tter</td>
                <td>die M<strong>ü</strong>tter</td>
            </tr>
            <tr>
                <td>der V<strong>a</strong>ter</td>
                <td>die V<strong>ä</strong>ter</td>
            </tr>
            <tr>
                <td>der Br<strong>u</strong>der</td>
                <td>die Br<strong>ü</strong>der</td>
            </tr>
            <tr>
                <td>die T<strong>o</strong>chter</td>
                <td>die T<strong>ö</strong>chter</td>
            </tr>
            <tr>
                <td>die Schwester</td>
                <td>die Schwester<strong>n</strong></td>
            </tr>
            </tbody>
        </table>
        <p>
            <em>Schwester</em> has an extra <em>-n</em>, because it can't change its vowel (<em>e</em> has no umlaut).
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='47'>47 <em>Eltern</em></h4>
    <div>
        <p>
            <em>Eltern</em> (parents) has no singular, unlike in English. We normally refer to <em>Mutter</em> or <em>Vater</em>
            then.
        </p>
        <p>
            If necessary, there is a word <em>das Elternteil</em> (literally, "the parents part"). But this is only used
            in formal settings, for example on forms.
        </p>
    </div>
    <h4 class="p-2 mt-5 mb-2 bg-info text-white" id='48'>48 Alternative words for family members</h4>
    <div>
        <p>
            There are countless alternative words for certain family members. A lot of them are regionalisms or
            influenced by your own family's heritage. Some of them are ambiguous as well. For instance, some people call
            their father "papa", and some people call their grandfather "papa".
        </p>
        <p>
            We can't accept all these terms, and since translations used in the German course for English speakers may
            also pop up in the English course for German speakers, we don't want to confuse German speakers with these
            words. Please understand that we're not going to add more alternatives. In your own interest, stick to the
            ones suggested by Duolingo (see above).
        </p>
    </div>
</div>

</body>
</html>